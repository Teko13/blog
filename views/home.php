<section id='header'>
    <div class="container header__container">
        <div class="me">
            <img src="./assets/moi-sans-font.png" alt="" />
        </div>
        <h5>Hello Moi c'est</h5>
        <h1>Teko Fabrice</h1>
        <h5 class="text-light">Developpeur Full Stack</h5>
        <div class='header__socials'>
            <a href="https://www.linkedin.com/in/teko-fabrice-folly-708a28233" target='_blank'>Ln</a>
            <a href="https://github.com/Teko13" target='_blank'>Gi</a>
        </div>
        <div class='cta'>
            <a href="./assets/cv.pdf" download class='btn btn-primary'>Télécharger mon CV</a>
        </div>
    </div>
    <div class="scroll-down">
        <a href="#footer" class="mouse-wrapper">
            <span class='mouse'>
                <span class='whell'></span>
            </span>
        </a>
    </div>
</section>

<section id='about'>
    <h5>À Propos</h5>
    <h2>De Moi</h2>

    <div class="container about__container">
        <div class="about__me">
            <div class="about__me-image">
                <img src="./assets/moi-font-bleu.jpg" alt="Ma foto" />
            </div>
        </div>
        <div class="about__content">
            <div class="resume">
                <p>
                    Yo, c'est moi ! Le développeur ninja en alternance chez OpenClassRooms, en train de préparer mon
                    diplôme de niveau 6 en développement backend. Mais avant ça, j'ai déjà été diplômé du parcours
                    Développeur Web. Autant dire que je maîtrise les langages de programmation comme personne (sauf
                    peut-être mon ordinateur, mais chut, ne le dites à personne).

                    Je suis capable de faire des merveilles en parlant avec mon ordi, mais je ne me limite pas à ça. Je
                    suis un touche-à-tout : back-end, front-end, je suis partout ! Si vous me cherchez, vous me
                    trouverez en train de coder avec la musique à fond, ou en train de réfléchir à un nouveau projet
                    (parfois même en dormant).

                    Mais attention, je suis aussi un redoutable guerrier contre les bugs. Ils n'ont qu'à bien se tenir,
                    car je ne recule devant rien pour trouver la solution !

                    Bref, si vous voulez discuter avec un développeur qui a de l'humour et des compétences, vous êtes au
                    bon endroit. Allez, venez, je ne mords pas (enfin, sauf si vous êtes un bug).
                </p>
                <a href="#contact" class='btn btn-primary'>Me Contacter</a>
            </div>
            <div class="skills">
                <div class="backend">
                    <div class="skills-title">
                        <h3>Backend</h3>
                        <h5>65%</h5>
                    </div>
                    <div class="bar">
                        <div class="progress-bar"></div>
                    </div>
                </div>
                <div class="frontend">
                    <div class="skills-title">
                        <h3>Frontend</h3>
                        <h5>80%</h5>
                    </div>
                    <div class="bar">
                        <div class="progress-bar"></div>
                    </div>
                </div>
                <div class="unix">
                    <div class="skills-title">
                        <h3>System Unix</h3>
                        <h5>55%</h5>
                    </div>
                    <div class="bar">
                        <div class="progress-bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about__cards">
        <article class="about__card">
            <FaAward class='about__icon' />
            <h5>Diplômes</h5>
            <small>Titre RNCP niveau 5 (bac+2)</small><br />
            <small>Préparation RNCP niveau 6 (bac+3/4)</small>
        </article>
        <article class="about__card">
            <VscFolderLibrary class='about__icon' />
            <h5>Projets</h5>
            <small>Pluisieur projet pro valider et soutenus</small>
        </article>
        <article class="about__card">
            <FiUser class='about__icon' />
            <h5>Soft skills</h5>
            <small>
                <ul>
                    <li>Autonomie</li>
                    <li>Curiosité</li>
                    <li>Rigueur</li>
                    <li>Persévérance</li>
                </ul>
            </small>
        </article>
    </div>
</section>

<section id='contact'>
    <h5>Me</h5>
    <h2>Contacter</h2>
    <div class="container contact__container">
        <div class="contact__options">
            <article class="contact__option">
                <MdOutlineEmail class='contact__option-icon' />
                <h4>Email</h4>
                <h5>tekofabricefolly@gmail.com</h5>
                <a href="mailto:tekofabricefolly@gmail.com" target='_blank'>M'envoyer un mail</a>
            </article>
            <article class="contact__option">
                <FaTelegramPlane class='contact__option-icon' />
                <h4>Telegram</h4>
                <h5>@teko_fabrice</h5>
                <a href="https://t.me/teko_fabrice" target='_blank'>M'envoyer un message</a>
            </article>
            <article class="contact__option">
                <BsWhatsapp class='contact__option-icon' />
                <h4>Whatsapp</h4>
                <h5>+33 6 18 14 57 85</h5>
                <a href="https://wa.me/+33618145785" target='_blank'>M'envoyer un message</a>
            </article>
        </div>
        <form action="/contact" method="post">
            <input type="text" name='name' placeholder='Votre nom complet' required />
            <input type="email" name='email' placeholder='Votre mail' required />
            <textarea name="message" rows='7' placeholder='Votre message' required></textarea>
            <button class='btn btn-primary' type='submit'>Envoyer</button>
        </form>
    </div>
</section>
