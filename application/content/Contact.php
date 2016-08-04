<div class="wrapper-back">
    <div class="main-back">
        <div class="contact-page">
            <h1>Contact Me</h1>
            <div id="form-messages"></div>
            <form id="ajax-contact" method="post" action="mailer">
                <div class="field">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="field">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="field">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>

                <div class="field">
                    <button type="submit">Send</button>
                </div>
            </form>
        </div>
    </div><!-- Main -->
</div>