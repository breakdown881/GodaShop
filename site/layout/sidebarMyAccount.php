<aside class="col-md-3">
                <div class="inner-aside">
                    <div class="category">
                        <ul>
                            <li class="<?=$_GET["a"] == "infoAccount" ? "active" : "" ?>" >
                                <a href="index.php?c=customer&a=infoAccount" title="Thông tin tài khoản" target="_self">Thông tin tài khoản
                                </a>
                            </li>
                            <li class="<?=$_GET["a"] == "shippingAddress" ? "active" : "" ?>">
                                <a href="index.php?c=customer&a=shippingAddress" title="Địa chỉ giao hàng mặc định" target="_self">Địa chỉ giao hàng mặc định
                                </a>
                            </li>
                            <li class="<?=$_GET["c"] == "order" ? "active" : "" ?>">
                                <a href="index.php?c=order&a=list" target="_self">Đơn hàng của tôi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>