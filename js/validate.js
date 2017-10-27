<script>
/* 
 * validteYadda.js
 * This javascript function verifies if "password" and "repeat password" matches
 * @Project: YaddaYaddaYadda
 * @author: Marianne, Jepser, Peter & Daniel
 */
   'use strict';

    var check = function (e) {
window.alert('hallo');
        if (document.forms.yaddaform.text.value == '') {
            window.alert("Only Yaddas with text");
            document.forms.yaddaform.text.focus();
            e.preventDefault();
            return false;
        } else { // text OK
            
            if (document.forms.yaddaform.img.value == '' 
                    && document.forms.yaddaform.text.value.length > 160) {
                window.alert("Your Yadda can only be 160 characters without image (140 with image)");
                document.forms.yaddaform.text.focus();
                e.preventDefault();
                return false;
            }
            
            if (document.forms.yaddaform.img.value <> '' 
                    && document.forms.yaddaform.text.value.length > 140) {
                window.alert("Your Yadda can only be 140 characters with image");
                document.forms.yaddaform.text.focus();
                e.preventDefault();
                return false;
            }
        }
    };

    var init = function () {
        document.forms.yaddaform.addEventListener('submit', check);
    };
    window.addEventListener('load', init);

</script>