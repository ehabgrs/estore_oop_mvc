
    var userNameField = document.querySelector('input[name="username"]');
//i added this to prevent the message from appear at edit and be just with create
    var userCreate = document.getElementById('create');
   
    if(null !== userNameField && null !== userCreate) {
        //event listener blur means activated when we put field on form and press enter
        userNameField.addEventListener('blur', function()
        {
            var req = new XMLHttpRequest();
            req.open('POST', 'http://ehabsalib.rf.gd/users/checkUserExistsAjax');
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            req.onreadystatechange = function()
            {
                var iElem = document.createElement('i');
                if(req.readyState == req.DONE && req.status == 200) {
                    if(req.response == 1) {
                        iElem.className = 'text-danger';
                        iElem.innerHTML = 'This username is used before';
                    } else if(req.response == 2) {
                        iElem.className = 'text-success';
                        iElem.innerHTML = 'This username is available';
                    }
                    var iElems = userNameField.parentNode.childNodes;
                    for ( var i = 0, ii = iElems.length; i < ii; i++ )
                    {
                        if(iElems[i].nodeName.toLowerCase() == 'i') {
                            iElems[i].parentNode.removeChild(iElems[i]);
                        }
                    }
                    userNameField.parentNode.appendChild(iElem);
                }
            }
            req.send("username=" + this.value);
        }, false);
    };
