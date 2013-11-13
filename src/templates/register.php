<section>
    <h2>Rejestracja</h2>
            <form action="aditionalInfo.html" method="get">
                <h4>Nazwa profilu</h4>
                <input type="text" name="userLogin">
                <h4>Hasło</h4>
                <input type=password name="userPassword">
                <h4>Hasło</h4>
                <input type=password name="userPasswordRepeated">
                <h4>Imię</h4>
                <input type="text" name="userName" autocomplete="on">
                <h4>Nazwisko</h4>
                <input type="text" name="surname" autocomplete="on" required>
                <h4>Adres e-mail</h4>
                <input type="email" name="userMail" autocomplete="on" required pattern="^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$">
                <h4>Telefon</h4>
                <input type="tel" name="userPhone">
                <h4>Płeć</h4>
                <input type="radio" name="userSex" id="userFamale" value="K">
                <label for="userFamale">Kobieta</label>
                <input type="radio" name="userSex" id="userMale" value="M">
                <label for="userMale">Mężczyzna</label>
                <h4>Miasto</h4>
                <input type="text" name="city">
                <h4>Data urodzenia</h4>
                <input type="date" name="birthDate">
                <p>
                <input type="submit" id="submit" value="Zarejestruj"/>
                <input type="reset" value="Wyczyść" />
                </p>
            </form>          
        
</section>
    
