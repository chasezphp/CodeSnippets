function check_mobile(mobile) {
    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;

    if (!myreg.test(mobile)) {
        return false;
    } else {
        return true;
    }
}