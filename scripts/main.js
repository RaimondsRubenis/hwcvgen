function addItems(item) {
  if(item == 'edu'){
    var file = "cv-part-education.html";
    var parentElement = document.getElementById('education-container');
  } else {
    var file = "cv-part-language.html";
    var parentElement = document.getElementById('language-container');
  }

  var contentFile = new XMLHttpRequest();
  contentFile.open("GET", file, true);
  contentFile.onreadystatechange = function() {
    if (contentFile.readyState === 4) {
      if (contentFile.status === 200) {
        content = contentFile.responseText;
        parentElement.insertAdjacentHTML('beforeend', content);
      }
    }
  }
  contentFile.send(null);
}

function deleteItem(e)
{
    e.parentNode.parentNode.removeChild(e.parentNode);
}
