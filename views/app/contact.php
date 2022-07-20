<?php  include VIEWS.'inc/header.php'; ?>

<!-- <form action="" enctype="multipart/form-data" method="post">
    Email: <input type="text" name="email" value="" />
    <br />
    Objet: <input type="text" name="objet" value="" />
    <br />
    Message: <textarea name="message" cols="40" rows="20"></textarea>
    <br />
    <input type="submit"/>
</form> -->

<section id="section">

    <div class="page-content" id="page">

	    <div class="form-v5-content" id="contenu">

		    <div class="image" id="img">
                <img src="../../asset/images/mascotte5.png">				
		    </div>
<!-- </main> -->

            <h2 id="contact">CONTACTEZ-NOUS</h2>

		    <form class="form-detail" id="formulaire" action="" enctype="multipart/form-data" method="post">

			    <div class="form-row" id="divInput">
				    <label for="email">Votre Email</label>
				    <input type="text" name="email" id="email" class="input-text" placeholder="test@gmail.fr" >
				    <i class="fas fa-envelope" id="enveloppe"></i>
			    </div>
			
			    <div class="form-row" id="divInput">
				    <label for="text">Objet</label>
				    <input type="text" name="objet" class="input-text" required>
			    </div>	
				
			    <!-- <div class="form-row" id="divInput">
				    <label for="msg">Message :</label>
				    <textarea type="text" id="msg" name="message" class="input-text"></textarea>
			    </div>				 -->
				<label for="msg">Message</label>
				<div class="form-floating">
					<textarea class="form-control"  id="msg" name="message" ></textarea>
				</div>


			    <div class="form-row-last" id="divSubmit">
				    <input type="submit" name="register" class="register" value="Envoyer">
			    </div>
	
				
		    </form>
	    </div>
    </div>
</section>
<?php  include VIEWS.'inc/footer.php'; ?>