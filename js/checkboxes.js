    
function check_all(source) {
  checkboxes = document.getElementsByName('delete[]');
  var n=checkboxes.length;
  for(var i=0;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
