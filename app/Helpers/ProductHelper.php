<?php

namespace App\Helpers;
use App\Models\Admin\Product;
use App\Models\Admin\Inventory;
use App\Models\Admin\PurchaseOrderItem;
use App\Models\Admin\PurchaseOrder;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductHelper
{
	function getSkubyProduct($product_id){
		$sku = Product::where("id",$product_id)->first();
		if($sku){
			return $sku['sku'];
		}
		else{
			return 0;
		}
	}
	function getQtybyProductSku($product_sku){
		$skus = explode("_",$product_sku);
		if(count($skus) == 2){
            if($skus[0] == $skus[1]){
                $qty = 1;
            }
            else{
                $qty = round($skus[1] / 1000,4);
            }
        }
        else{
            $qty = 1;
        }
        return $qty;
	}	
	function getProductAvalQty($product_sku,$delivery_date=null){
		if(!$delivery_date){
			$delivery_date = date("Y-m-d");
		}
		$stock = Inventory::where("sku",$product_sku)->select("available_qty")->first();
		$final_qty = 0;
		$p_qty = 0;
		$product_data = Product::where("sku",$product_sku)->first();
		if($stock && $stock['available_qty'] > 0){
			$final_qty += $stock['available_qty'];
		}
		if($product_data['parent'] > 0){
			$skus = explode("_",$product_sku);
			$parent = Inventory::where("sku",$skus[0])->select("available_qty")->first();
			if($parent){
				$parent_qty = $parent['available_qty'];
			}
			else{
				$parent_qty = 0;
			}
			
            $child_repack = $product_data['uom_repack'];
            if($product_data['parent'] == 0){
                $parent_product = $product_data;
            }
            else{
                $parent_product = Product::where("id",$product_data['parent'])->first();
            }
            $parent_repack = $parent_product['uom_repack'];
            $p_qty = round( $child_repack / $parent_repack , 4);
            if(!$p_qty){
                $p_qty = 1;
            }
            $final_qty += floor($parent_qty / $p_qty);
		}

		//check if any po is arriving if delivery date of future
		$today = date("Y-m-d");
		if($today !== $delivery_date){
			$tomorrow = date("Y-m-d",strtotime("+1 days"));
			$po_items = PurchaseOrderItem::select(DB::raw("sum(`purchase_order_items`.`qty`) as qty"),'purchase_order_items.probability')
						->Join("purchase_orders","purchase_orders.id","purchase_order_items.po_id")
						->where("purchase_order_items.product",$product_data['id'])
						->where("purchase_orders.delivery_date",">",$today)
						->where("purchase_orders.delivery_date","<=",$delivery_date)
						->groupBy("purchase_orders.id")->first();
			if($po_items && $po_items['qty'] && $po_items['qty'] > 0){
				$final_qty += round( $po_items['qty'] * round($po_items['probability'] / 100 ,2),2);
			}
			if($product_data['parent'] > 0){
				$po_items_parent = PurchaseOrderItem::select(DB::raw("sum(`purchase_order_items`.`qty`) as qty"),'purchase_order_items.probability')
						->Join("purchase_orders","purchase_orders.id","purchase_order_items.po_id")
						->where("purchase_order_items.product",$product_data['parent'])
						->where("purchase_orders.delivery_date",">",$today)
						->where("purchase_orders.delivery_date","<=",$delivery_date)
						->first();
				if($po_items_parent['qty'] && $po_items_parent['qty'] > 0){
					$po_items_parent = round( $po_items_parent['qty'] * round($po_items_parent['probability'] / 100 ,2),2);
					$final_qty += round($po_items_parent / $p_qty, 2);
				}
			}

		}	
		return $final_qty;
	}

	public function getParentProduct($product_id)
	{
		$parent = Product::where("id",$product_id)->select("parent")->first();
		if($parent){
			return $parent['parent'];
		}
		else{
			return 0;
		}
	}

	public function getParentQty($product_id,$qty)
	{
		$parent = Product::where("id",$product_id)->select("sku")->first();
		if($parent){
			$skus = $parent['sku'];
			$skus = explode("_",$skus);
			if(count($skus) == 2){
	            if($skus[0] == $skus[1]){
	                $p_qty = 1;
	            }
	            else{
	                $p_qty = round($skus[1] / 1000,4);
	            }
	        }
	        else{
	            $p_qty = 1;
	        }
	        return round($p_qty * $qty,4);
		}
		else{
			return 0;
		}
	}

	function getPackingBatchNo(){
        $year = substr(date("y"), -1);
        $month_arr = array(
            "01" => "A",
            "02" => "B",
            "03" => "C",
            "04" => "D",
            "05" => "E",
            "06" => "F",
            "07" => "G",
            "08" => "H",
            "09" => "I",
            "10" => "J",
            "11" => "K",
            "12" => "L"
        );
        $month = $month_arr[date("m")];
        $batch = $year.$month."0".date("d");
        return $batch;
    }

    function amountInWords($number){
    	$no = floor($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => 'zero', '1' => 'one', '2' => 'two',
		'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
		'7' => 'seven', '8' => 'eight', '9' => 'nine',
		'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
		'13' => 'thirteen', '14' => 'fourteen',
		'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
		'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
		'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
		'60' => 'sixty', '70' => 'seventy',
		'80' => 'eighty', '90' => 'ninety');
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
		 $divider = ($i == 2) ? 10 : 100;
		 $number = floor($no % $divider);
		 $no = floor($no / $divider);
		 $i += ($divider == 10) ? 1 : 2;
		 if ($number) {
		    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
		    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
		    $str [] = ($number < 21) ? $words[$number] .
		        " " . $digits[$counter] . $plural . " " . $hundred
		        :
		        $words[floor($number / 10) * 10]
		        . " " . $words[$number % 10] . " "
		        . $digits[$counter] . $plural . " " . $hundred;
		 } else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
		"& " . ucwords($words[$point / 10]) . " " . 
		      ucwords($words[$point = $point % 10]) : '';
		return ucwords($result) . "Rupees  " . $points . " Paise";
    }
}
