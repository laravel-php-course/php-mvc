<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="">Previous</a></li>
        <li class="page-item"><a class="page-link" href="/user">user</a></li>
        <li class="page-item"><a class="page-link" href="/contact">contact</a></li>
        <li class="page-item"><a class="page-link" href="/">home</a></li>
        <li class="page-item"><a class="page-link" href="">Next</a></li>
    </ul>
</nav>
<div class="container">{{content}}</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<script>

        const linkss = document.querySelectorAll('a');

    linkss.forEach(link => {
        if (link.innerText.trim().toLowerCase() === 'Previous') {
            link.addEventListener('click', () => {
                window.history.back();
                console.log("a")
            });
        }
    });

</script>