
<div class="intro">
    <video autoplay muted loop id="myVideo">
    <source src="../img/Bg2.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
    <div class="introWrapper">
        <div class="introtext1_wrapper">
            <p class="introtext1 animate__animated animate__bounceInDown">Junk Recycling by</p>
        </div>
        <div class="introtext2_wrapper">
        <p class="introtext2 animate__animated animate__bounceInUp">Junk Broker</p>
        </div>
        <div class="introtext3_wrapper">
        <p class="introtext3 animate__animated animate__bounceInUp">Got some junk? Get free and authentic junk removal.</p>
        </div>
        <div class="exploreContainer">
            <a 
                class="exploreBtn animate__animated animate__zoomIn animate__delay-1s"
                id="scrollBtn1"
            >Book Now</a>
            <a 
                class="exploreBtn animate__animated animate__zoomIn animate__delay-1s"
                data-bs-toggle='modal' data-bs-target='#loginModal'
            >Admin Login</a>
            <a 
                class="exploreBtn animate__animated animate__zoomIn animate__delay-1s"
                data-bs-toggle='modal' data-bs-target='#trackModal'
            >Track your Request</a>
        </div>
    </div>
</div>

<div class="whoContainer" id="whoarewe">
    <div class="whoTextContainer">
        <h3 class="whoIntro">WHO ARE WE?</h3>
        <h5 class="whoIntro">We Cash the TRASH !!</h5><br>
        <p class="whoText">By taking small measures, Junkbroker is moving towards more environment friendly and budget friendly world. <br><br>The main goal of our team is :<br>
        <li>Collecting Junk with no charges.</li>
        <li>Investing money & time in recycling Junk.</li>
        <li>Getting profits from recycled products.</li>
    </p>
    <p class="whoText"> So let's connect together. This is a big profit to you, our team and majorly to our EARTH. </p>
    </div>
    <div class="whoImage">
        <img src="../img/WhoAreWe.jpg" alt="Who are we Logo" style="width:30em;height:30em;border-radius:1em"> 
    </div>
</div>

<form 
    action=
        <?php if($page == 'Home') 
        {
            echo 'includes/validateAndAddRequest.php';
        }
        else
        {
            echo 'validateAndAddRequest.php';
        }
        ?> method="post"
    class="myForm" id="reqForm" enctype="multipart/form-data">
    <div class="formIntroContainer">
        <h3 class="formIntro">Request Service</h3>
        <p class="formIntroSmall">Contribute to the Earth</p>
    </div>
    <div class="myFormContainer">
        <div class="form-floating">
            <input type="text" class="form-control" id="name" placeholder="Enter Full Name" name="fullName">
            <label for="name">Enter Full Name</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
            <label for="email">Enter Email ID</label>
        </div>
        <div class="form-floating">
            <input type="tel" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
            <label for="phone">Enter Phone Number : (xxx)xxx-xxxx</label>
        </div>
        <select name="custLocation" id="custLocation" class="form-select" aria-label="Default select example" style="margin-bottom:1em">
            <option selected>Select Location</option>
            <option value="San Jose">San Jose</option>
            <option value="San Francisco">San Francisco</option>
        </select>
        <div class="form-floating">
            <textarea type="text" class="form-control" id="address" placeholder="Enter Address" name="address"></textarea>
            <label for="address">Enter Address</label>
        </div>

        <label class="outsideLabel" for="formFileMultiple">Upload an Image/Video of the Trash</label>
        <input class="form-control" type="file" name="formFileMultiple" id="formFileMultiple" accept="video/*,image/*" style="margin-bottom:1em">

        <div class="form-floating">
            <textarea type="text" class="form-control" id="comments" placeholder="Enter Comments" name="comments"></textarea>
            <label for="comments">Describe the Junk</label>
        </div>
        
        <!-- <label>Available Date</label>
        <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div> -->
        <label class="outsideLabel" for="startDate">Request Date for Pick up</label>
        <input name="startDate" id="startDate" class="form-control" style="padding:1em;margin-bottom:1em" type="date" />
        
        <select name="pickATime" class="form-select" aria-label="Default select example" style="margin-bottom:1em">
            <option selected>Select your available time</option>
            <option value="9AM - 12PM">9AM - 12PM</option>
            <option value="1PM - 3PM">1PM - 3PM</option>
            <option value="4PM - 7PM">4PM - 7PM</option>
        </select>

        <div class="signUpBtnContainer">
            <input type="submit" name="Signup" class="signUpBtn signUpmodal-submit" data-bs-toggle='modal' data-bs-target='#submitModal' value="Submit">
        </div>
    </div>
</form>

 <!-- The Modal -->
 <div class="modal fade modal-md" id="trackModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Track Your Request</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="includes/track.php" method="post">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="trackemail" placeholder="Enter Email" name="trackemail">
                        <label for="email">Enter your Email ID</label>
                    </div>
                    <div class="signUpBtnContainer">
                        <input type="submit" name="Signup" class="signUpBtn signUpmodal-submit" data-bs-toggle='modal' data-bs-target='#tracksubmitModal' value="Track">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>