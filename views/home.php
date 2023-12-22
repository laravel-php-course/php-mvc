<h1>Welcome <?= $name ?></h1>
<script>

    const links = document.querySelectorAll('a.page-link');

    links.forEach(link => {
        if (link.classList.contains('active')) {
            link.classList.remove('active');
        }
    });

    links[3].classList.add('active');

    const link = document.querySelectorAll('a');

    link.forEach(link => {
        if (link.textContent.trim().toLowerCase() === 'next') {

            const nextPageURL = '/user';
            link.setAttribute('href', nextPageURL);
        }
    });

</script>