<?php
session_start();
$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  // フォームの送信時にエラーをチェックする
  if ($_POST['name'] === '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] === '') {
    $error['email'] = 'blank';
  } else if (!filter_var($post['email'],FILTER_VALIDATE_EMAIL)) {
    $error['email'] = 'email';
  }
  if ($_POST['contact'] === '') {
    $error['contact'] = 'blank';
  }

  if ( count($error) === 0) {
    //エラーがないので確認画面に移動
    $_SESSION['form'] = $post;
    header('Location: confirm.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <form action="" method="POST" novalidate>
      <p>お問い合わせ</p>
      <div class="form-group">
        <div class="row">
          <div class="col-2">
            <label for="">お名前</label>
          </div>
          <div class="col-2">
            <p class="require_item">必須</p>
          </div>
          <div class="col-md-8">
            <input type="text" name="name" id="inputName" class="form-control" value="<?php echo htmlspecialchars($post['name']); ?>" required autofocus>
            <?php if ($error['name'] === 'blank'): ?>
            <p class="error_msg">※お名前をご記入下さい</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-2">
            <label for="">メールアドレス</label>
          </div>
          <div class="col-2">
            <p class="require_item">必須</p>
          </div>
          <div class="col-8">
            <input type="email" name="email" id="inputName" class="form-control" value="<?php echo htmlspecialchars($post['email']); ?>" required>
            <?php if ($error['name'] === 'blank'): ?>
            <p class="error_msg">※メールアドレスをご記入下さい</p>
            <?php endif; ?>
            <?php if ($error['name'] === 'email'): ?>
            <p class="error_msg">※メールアドレスを正しくご記入下さい</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-2">
            <label for="">お問い合わせ内容</label>
          </div>
          <div class="col-2">
            <p class="require_item">必須</p>
          </div>
          <div class="col-8">
            <textarea name="contact" id="inputName" cols="30" rows="10" class="form-control" required><?php echo htmlspecialchars($post['name']); ?></textarea>
            <?php if ($error['name'] === 'blank'): ?>
            <p class="error_msg">※お問い合わせ内容をご記入下さい。</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-8 offset-4">
          <button type="submit">確認画面へ</button>
        </div>
      </div>
    </form>
  </div>
  
</body>
</html>