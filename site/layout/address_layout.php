<div class="row">
    <div class="form-group col-sm-6">
        <input type="text" value="<?=$customer_shipping_name?>" class="form-control" name="fullname" placeholder="Họ và tên" required="" oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')" oninput="this.setCustomValidity('')">
    </div>
    <div class="form-group col-sm-6">
        <input type="tel" value="<?= $customer_shipping_mobile?>" class="form-control" name="mobile" placeholder="Số điện thoại" required="" pattern="[0][0-9]{9,}" oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại bắt đầu bằng số 0 và ít nhất 9 con số theo sau')" oninput="this.setCustomValidity('')">
    </div>
    <div class="form-group col-sm-4">
        <select name="province" class="form-control province" required="" oninvalid="this.setCustomValidity('Vui lòng chọn Tỉnh / thành phố')" oninput="this.setCustomValidity('')">
            <option value="">Tỉnh / thành phố</option>
            <?php 
            foreach ($provinces as $province) {
                ?>
                <option <?=$customer_province_id==$province->getId() ? "selected" : ""?> value="<?=$province->getId()?>"><?=$province->getName()?></option>
                <?php 
            }
            ?>
        </select>
    </div>
    <div class="form-group col-sm-4">
        <select name="district" class="form-control district" required="" oninvalid="this.setCustomValidity('Vui lòng chọn Quận / huyện')" oninput="this.setCustomValidity('')">
            <option value="">Quận / huyện</option>
            <?php 
            foreach ($districts as $district) {
                ?>
                <option <?=$customer_district_id==$district->getId() ? "selected" : ""?> value="<?=$customer_district_id?>"><?=$district->getName()?></option>
                <?php 
            }
            ?>
        </select>
    </div>
    <div class="form-group col-sm-4">
        <select name="ward" class="form-control ward" required="" oninvalid="this.setCustomValidity('Vui lòng chọn Phường / xã')" oninput="this.setCustomValidity('')">
            <option value="">Phường / xã</option>
            <?php 
            foreach ($wards as $ward) {
                ?>
                <option <?=$customer_ward_id==$ward->getId() ? "selected" : ""?> value="<?=$ward->getId()?>"><?=$ward->getName()?></option>
                <?php 
            }
            ?>
            
        </select>
    </div>
    <div class="form-group col-sm-12">
        <input type="text" value="<?=$housenumber_street?>" class="form-control" placeholder="Địa chỉ" name="address" required="" oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ bao gồm số nhà, tên đường')" oninput="this.setCustomValidity('')">
    </div>
</div>