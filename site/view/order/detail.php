<?php 
include "layout/header.php";
?>
<main id="maincontent" class="page-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                <ol class="breadcrumb">
                    <li><a href="/" target="_self">Trang chủ</a></li>
                    <li><span>/</span></li>
                    <li class="active"><span>Tài khoản</span></li>
                </ol>
            </div>
            <div class="clearfix"></div>

            <?php include "layout/sidebarMyAccount.php" ?>

            <div class="col-md-9 order-info">
                <div class="row">
                    <div class="col-xs-6">
                        <h4 class="home-title">Đơn hàng #<?=$order->getId()?></h4>
                    </div>
                    <div class="clearfix"></div>
                    <aside class="col-md-7 cart-checkout">
                         <?php 
                            $orderItems = $order->getOrderItems();
                            $sum = 0;
                        foreach ($orderItems as $orderItem) {
                            ?>
                        <div class="row">
                            <div class="col-xs-2">
                                <img class="img-responsive" src="../upload/<?=$orderItem->getProduct()->getFeaturedImage()?>" alt="<?=$orderItem->getProduct()->getName()?>"> 
                            </div>
                            <div class="col-xs-7">
                                <a class="product-name" href="chi-tiet-san-pham.html"><?=$orderItem->getProduct()->getName()?></a>
                                <br>
                                <span><?=$orderItem->getQty()?></span> x <span><?=number_format($orderItem->getUnitPrice())?>₫</span>
                            </div>
                            <div class="col-xs-3 text-right">
                                <span><?=number_format($orderItem->getTotalPrice())?>₫</span>
                            </div>
                        </div>
                            <?php 
                                $sum += $orderItem->getTotalPrice();
                                    }
                                    ?>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                Tạm tính
                            </div>
                            <div class="col-xs-6 text-right">
                                <?=number_format($sum)?>đ
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                Phí vận chuyển
                            </div>
                            <div class="col-xs-6 text-right">
                                <?=number_format($order->getShippingFee())?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                Tổng cộng
                            </div>
                            <div class="col-xs-6 text-right">
                                <?=number_format($sum + $order->getShippingFee())?>đ
                            </div>
                        </div>
                    </aside>
                    <div class="ship-checkout col-md-5">
                        <h4>Thông tin giao hàng</h4>
                        <div>
                            Họ và tên: <?=$order->getShippingFullname()?>                            
                        </div>
                        <div>
                            Số điện thoại: <?=$order->getShippingMobile()?>                            
                        </div>
                        <div>
                            <?php $ward=$order->getShippingWard(); ?>
                            <?=$ward->getDistrict()->getProvince()->getName()?>                            
                        </div>
                        <div>
                            <?=$ward->getDistrict()->getName()?>                           
                        </div>
                        <div>
                            <?=$ward->getName()?> 
                                                     
                        </div>
                        <div>
                              <?=$order->getShippingHousenumberStreet()?>                       
                        </div>
                        <div>
                            Phương thức thanh toán: <?= $order->getPaymentMethod()==0 ? "COD" : "bank"?>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php 
include "layout/footer.php";
?>