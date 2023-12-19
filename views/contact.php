<?php /** @var $request \App\core\Request */
//TODO زیبا سازی متن های ارور و پدینگ و مارجین و
?>
<h1 class="my-3">Contact Us</h1>
<form action="" method="post">
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input name="subject" type="text" class="form-control" id="subject">
    </div>
    <div class="text-danger">
        <?= $request->getFirstError('subject'); ?>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="text-danger">
        <?= $request->getFirstError('email'); ?>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" id="body" class="form-control" rows="5"></textarea>
    </div>
    <div class="text-danger">
        <?= $request->getFirstError('body'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>