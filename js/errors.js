const errMsg = () => {
  const url_string = window.location.search;
  const url_params = new URLSearchParams(url_string);
  const err_key = url_params.get('error');
  const inputs = url_params.get('invalidInputs');
  const board = document.querySelector('.user_form__msg');

  if (err_key && inputs) {
    const err_msg = {
      unknown: 'Something went wrong!',
      invalidPassword: 'Your password is incorrect!',
      distinctPass: 'Your password does not match.',
      registerdEmail: 'Email already in use.',
      invalidEmail: 'Please enter correct format of an email.',
      emptyInputfields: 'All fields are required!',
      invalidInputLength: 'Invalid input length',
      weakPass: 'Your password is too weak.',
      incorrectPassword: 'Your password is incorrect.',
      invalidUser: 'User is not existed.',
      invalidImgType: 'Wrong type of file.',
      largeImgFile: 'Image is too large.',
      prdctInUse: 'Product alredy exists.',
      linkInUse: 'Link already in use.'      
    };
    const obj = Object.keys(err_msg);
    const val = Object.values(err_msg);

    for (const key of obj) {
      if (key === err_key) {
        board.classList.add('user_form__errmsg');
        board.innerHTML = val[obj.indexOf(key)];
      }
    }

    for (const inpt of inputs.split(' ')) {
      for (const elmt of document.getElementsByName(inpt)) {
        document.getElementById(elmt.id).parentElement.classList.add('invalid');
      }
    }
  }
};

window.addEventListener('load', errMsg);
