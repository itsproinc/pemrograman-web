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
            <div>
                <li class="valign-wrapper">
                    <i class="material-icons">account_circle</i>
                    <span>Profile</span>
                </li> 
            </div>
        </button> 
    </a>   
    
    <!-- Addresses -->
    <a href="">
        <button class="waves-effect waves-indigo btn">
            <div>
                <li class="valign-wrapper">
                    <i class="material-icons">home</i>
                    <span>Addresses</span>
                </li> 
            </div>
        </button>
    </a>

    <!-- Bank & Payment -->
    <a href="">
        <button class="waves-effect waves-indigo btn">
            <div>
                <li class="valign-wrapper">
                    <i class="material-icons">account_balance</i>
                    <span>Bank & Payment</span>
                </li> 
            </div>
        </button>  
    </a>  

    <!-- Change Password -->
    <a href="">
        <button class="waves-effect waves-indigo btn">
            <div>
                <li class="valign-wrapper">
                    <i class="material-icons">security</i>
                    <span>Change Password</span>
                </li> 
            </div>
        </button>  
    </a>
    <hr>

    <!-- My Orders -->
    <a href="">
        <button class="waves-effect waves-indigo btn">
            <div>
                <li class="valign-wrapper">
                    <i class="material-icons">shopping_cart</i>
                    <span>My Orders</span>
                </li> 
            </div>
        </button>  
    </a>
    </ul>
</html>