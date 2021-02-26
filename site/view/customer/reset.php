<?php 
include "layout/header.php";
?>
<main id="maincontent" class="page-main">
            <div class="container">
                <div class="row">

                    <div class="col-md-9 account">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4 class="home-title">Reset Password</h4>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <form class="info-account" action="index.php?c=customer&a=updatePW" method="POST" role="form">
                                    <input type="hidden" name="code" value="<?=$_GET["code"]?>">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="re-password" placeholder="Nhập lại mật khẩu mới" autocomplete="off" autosave="off" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')" oninput="this.setCustomValidity('')">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php 
include "layout/footer.php";
?>