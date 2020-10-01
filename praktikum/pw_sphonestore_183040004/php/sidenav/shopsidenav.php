<html>
    <ul class="sidenav" id="mobile-demo">
        <div class="myAccountMiniProfile">
          <img src="" alt="" class="miniProfilePicture">

          <div class="miniProfileDesc">
            <div>
              <p><b><?= $name ?></b></p>
            </div>

            <div>
              <p class="smaller-text"><?= $membertype ?><p>
            </div>
          </div>   
      </div>

      <a href="?m=0">
        <button class="waves-effect waves-indigo btn">
          <li class="valign-wrapper">
            <i class="material-icons">card_giftcard</i>
            <span>Product</span>
          </li> 
        </button> 
      </a> 
      
      <?php if(!$usingGET): ?>
        <a href="?m=0">
          <button class="waves-effect waves-indigo btn">
            <div>
              <li class="valign-wrapper">
                <i class="material-icons">picture_as_pdf</i>
                <span>PDF</span>
              </li> 
            </div>
          </button> 
        </a>   
      <?php endif ?>
    </ul>
</html>