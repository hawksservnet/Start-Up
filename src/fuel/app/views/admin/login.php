
      
      <?php echo Form::open(array("action"=>"admin/login",'class'=>'form-signin')) ?>
      <?= Form::csrf() ?>
        <h2 class="form-signin-heading">管理画面ログイン</h2>
<!--
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="clear text form-control" name="email" placeholder="name@example.com" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" class="clear text form-control" id="inputPassword" name="password" placeholder="英数8桁以上" required>
-->
        <label for="inputEmail" class="sr-only">account id</label>
        <input type="text" id="inputEmail2" class="clear text form-control" name="email" placeholder="アカウントID" required autofocus>
        <label for="inputPassword" class="sr-only">password</label>
        <input type="password" class="clear text form-control" id="inputPassword" name="password" placeholder="英数8桁以上" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
      <?php echo Form::close() ?>
<style>
 
      </style>