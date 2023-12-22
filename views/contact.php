<?php /** @var $request \App\core\Request */
?>
<h1 class="my-3">Contact Us</h1>
<form action="" method="post">
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input value="<?= $request->old('subject') ?>" name="subject" type="text" class="form-control <?= $request->hasError('subject') ? 'is-invalid' : '';?>" id="subject">
    </div>

    <?php if ($request->hasError('subject')): ?>
    <div class="alert alert-danger" role="alert">
        <?= $request->getFirstError('subject'); ?>
    </div>
    <?php endif;?>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input value="<?= $request->old('email') ?>" name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="alert alert-danger" role="alert">
        <?= $request->getFirstError('email'); ?>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" id="body" class="form-control" rows="5"><?= $request->old('body') ?></textarea>
    </div>
    <div class="alert alert-danger" role="alert">
        <?= $request->getFirstError('body'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    let divElement = document.querySelectorAll('div.alert');
divElement.forEach(div => {
    if (div.innerHTML.trim() === '') {
        div.style.display = 'none';
    }
})
</script>
<script>

    const links = document.querySelectorAll('a.page-link');

    links.forEach(link => {
        if (link.classList.contains('active')) {
            link.classList.remove('active');
        }
    });

    links[2].classList.add('active');

    const link = document.querySelectorAll('a');

    link.forEach(link => {
        if (link.textContent.trim().toLowerCase() === 'next') {

            const nextPageURL = '/';
            link.setAttribute('href', nextPageURL);
        }
    });

</script>