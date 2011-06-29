function cf_check_content(item, is_mail) {
  if (null == item) {
    return false;
  }
  var value = item.value;
  if (null == value || 0 == value.length || '' == value) {
    return false;
  }
  if (is_mail) {
    return cf_check_mail_content(value);
  }
  return true;
}

function cf_check_mail_content(value) {
  var atom = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';     // before  arobase
  var domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // domain name
  var regex; 
  regex  = '^' + atom + '+' + '(\.' + atom + '+)*';
  regex += '@' + '(' + domain + '{1,63}\.)+' + domain + '{2,63}$';
  var reg = new RegExp(regex, 'i');
  if(reg.test(value)) {
    return true;
  } else {
    return false;
  }
}