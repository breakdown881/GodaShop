<?php 
$customer_shipping_name = "";
$customer_shipping_mobile = "";
$customer_province_id = "";
$customer_district_id = "";
$customer_ward_id = "";
$districts = array();
$wards = array();
$housenumber_street = "";
$shipping_fee = 0;
if (!empty($customer)) {
    $customer_shipping_name = $customer->getShippingName();
    $customer_shipping_mobile = $customer->getShippingMobile();
        $customer_ward = $customer->getWard(); //lấy đối tượng ward_id, mã ward
        if (!empty($customer_ward)) {
            $customer_district = $customer_ward->getDistrict();
            $customer_province = $customer_district->getProvince();
            $districts = $customer_province->getDistricts();//từ tỉnh suy ra ds quận, huyện
            $wards = $customer_district->getWards();//từ quận suy ra ds phường,xã

            $customer_province_id = $customer_province->getId();
            $customer_district_id = $customer_district->getId();
            $customer_ward_id = $customer_ward->getId();
            $shipping_fee = $customer_province->getShippingFee();
        }
        $housenumber_street = $customer->getHousenumberStreet();
        
    }
    ?>
 