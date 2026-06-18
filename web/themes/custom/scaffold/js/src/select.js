var config = {create: false, allowEmptyOption: true,controlInput: null};
document.querySelectorAll('.form-select').forEach((el)=>{
  new TomSelect(el,config);
});
