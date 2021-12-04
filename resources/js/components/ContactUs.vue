<template>
      <div class="container">
          <!-- Addresses-->
          <section class="section section-md bg-gray-100">
              <div class="container">
                  <div class="row row-30">
                      <div class="col-sm-6 col-lg-4">
                          <!-- Box 1-->
                          <address class="box-1">
                              <p class="heading-4 box-1-title">United States</p>
                              <p class="box-1-address heading-5">9 Valley St. Brooklyn, NY 11203</p>
                              <p class="box-1-tel heading-3"><a href="tel:#">1-800-346-6277</a></p>
                          </address>
                      </div>
                      <div class="col-sm-6 col-lg-4">
                          <!-- Box 1-->
                          <address class="box-1">
                              <p class="heading-4 box-1-title">Canada</p>
                              <p class="box-1-address heading-5">500 Kingston Rd Toronto ON M4L 1V3</p>
                              <p class="box-1-tel heading-3"><a href="tel:#">1-780-964-1989</a></p>
                          </address>
                      </div>
                      <div class="col-sm-6 col-lg-4">
                          <!-- Box 1-->
                          <address class="box-1">
                              <p class="heading-4 box-1-title">Australia</p>
                              <p class="box-1-address heading-5">60 Marcus Clarke St, Canberra, ACT 2601</p>
                              <p class="box-1-tel heading-3"><a href="tel:#">61-02-6156-0706</a></p>
                          </address>
                      </div>
                  </div>
              </div>
          </section>
          <!-- Get in Touch-->
          <section class="section section-lg bg-default">
              <div class="container">
                  <h3>Get in Touch</h3>
                  <!-- RD Mailform-->
                  <form class="rd-form rd-mailform form-lg" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                      <div class="row row-30">
                          <div class="col-lg-4">
                              <div class="form-wrap form-wrap-icon">
                                  <input class="form-input" id="contact-name" type="text" name="name" data-constraints="@Required">
                                  <label class="form-label" for="contact-name">Name</label>
                                  <div class="icon form-icon mdi mdi-account-outline text-primary"></div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-wrap form-wrap-icon">
                                  <input class="form-input" id="contact-phone" type="text" name="phone" data-constraints="@PhoneNumber">
                                  <label class="form-label" for="contact-phone">Phone</label>
                                  <div class="icon form-icon mdi mdi-phone text-primary"></div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="form-wrap form-wrap-icon">
                                  <input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
                                  <label class="form-label" for="contact-email">E-mail</label>
                                  <div class="icon form-icon mdi mdi-email-outline text-primary"></div>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-wrap form-wrap-icon">
                                  <label class="form-label" for="contact-message">Message</label>
                                  <textarea class="form-input" id="contact-message" name="message" data-constraints="@Required"></textarea>
                                  <div class="icon form-icon mdi mdi-message-outline text-primary"></div>
                              </div>
                          </div>
                      </div>
                      <div class="form-wrap form-wrap-button">
                          <button class="button button-lg button-primary" type="submit">Send</button>
                      </div>
                  </form>
              </div>
          </section>
          <!-- Page Footer-->
      </div>
</template>

<script>
export default {
    name: "ContactUs"
}
</script>

<style scoped>

</style>
