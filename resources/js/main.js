'use script';

document.querySelectorAll('.delete_post').forEach(form => {
  form.addEventListener('submit', e => {
      e.preventDefault();

      if (!confirm('Sure to delete?')) {
          return;
      }

      form.submit();
  });
});

