'use script';

{
document.getElementById("delete_post").addEventListener("submit", e => {
  e.preventDefault();

  if (!confirm('Sure to delete?')){
    return;
  }
  e.target.submit();
});
}
