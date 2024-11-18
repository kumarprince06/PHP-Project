 <!-- Header Include -->
 <?php require APPROOT . '/views/includes/header.php'; ?>

 <!-- Start Content Page -->
 <div class="container-fluid bg-light py-5">
     <div class="col-md-6 m-auto text-center">
         <h1 class="h1">Contact Us</h1>
         <p>
             Have questions or need assistance? The Smart Shop team is here to help. Reach out to us, and we’ll get back to you promptly.
         </p>
     </div>
 </div>

 <!-- Start Map -->
 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4184.841728864048!2d88.4917221765253!3d22.58505113587824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a020ac6499c8499%3A0x17c545e20b241d8d!2sEcospace%20Business%20Park!5e0!3m2!1sen!2sin!4v1731909957097!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
 <!-- End Map -->

 <!-- Start Contact -->
 <div class="container py-5">
     <div class="row py-5">
         <form class="col-md-9 m-auto" method="post" role="form">
             <div class="row">
                 <div class="form-group col-md-6 mb-3">
                     <label for="inputname">Name</label>
                     <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Your Full Name">
                 </div>
                 <div class="form-group col-md-6 mb-3">
                     <label for="inputemail">Email</label>
                     <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Your Email Address">
                 </div>
             </div>
             <div class="mb-3">
                 <label for="inputsubject">Subject</label>
                 <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Reason for Contacting">
             </div>
             <div class="mb-3">
                 <label for="inputmessage">Message</label>
                 <textarea class="form-control mt-1" id="message" name="message" placeholder="Type your message here..." rows="8"></textarea>
             </div>
             <div class="row">
                 <div class="col text-end mt-2">
                     <button type="submit" class="btn btn-success btn-lg px-3">Submit</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
 <!-- End Contact -->



 <!-- Footer Include -->
 <?php require APPROOT . '/views/includes/footer.php'; ?>