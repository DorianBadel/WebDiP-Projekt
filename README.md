# WebDiP-Projekt -> najnovija grana je *regAJAX*

> Glavni repozitorij za projekt webdip-a

***

- [ ] 1. **Neregistrirani korisnik** - je korisnik koji nema korisnički račun na sustavu. Članom
sustava može postati u slučaju registracije na sustav. Kod registracije obavezno se
unose osobni podaci o korisniku, lozinka i potvrda lozinke. Korisnik se smatra
registriranim tek nakon aktivacije računa putem aktivacijske poruke elektroničke
pošte (poveznica za aktivaciju vrijedi 7 sati). Svaki neregistrirani korisnik prilikom prve
posjete stranici mora prihvatiti uvjete korištenja koji se odnose na bilježenje
podataka u kolačiće i to se bilježi u kolačić (koji traje 2 dana) tako da nije potrebno
svaki puta potvrđivati.

- [ ] 2. **Registrirani korisnik** - je korisnik koji ima kreiran i aktiviran korisnički račun. Prijava se
sastoji od jednog unosa korisničkog imena i lozinke. U slučaju 3 neuspješna unosa (za
redom), korisniku se zaključava pristup sustavu. Ponovno aktiviranje korisničkog
računa obavlja se od strane administratora sustava. U slučaju uspješne prijave na
sustav, postavlja se broj neuspješnih prijava na 0 (ako nije zaključen) i kreira se
korisnička sesija koja traje do isteka vremena podešenog od strane administratora
(konfiguracija) ili do odjave korisnika sa sustava. Registrirani korisnik ima sva prava
koja ima neregistrirani korisnik.

- [ ] 3. **Moderator** - ima sva prava koja ima i registrirani korisnik

- [ ] 4. **Kod svih uloga** - na svakom dijelu projekta gdje postoji kreiranje novih objekata (npr.
kategorije, korisnici, itd.) mora se napraviti i ažuriranje i pregled osim ako nije
drugačije navedeno u opisu Vašeg projektnog zadatka

- [ ] 5. **Administrator** - ima sva prava koja imaju sve prethodno definirane uloga na sustavu te
uz to ima CRUD (unos, ažuriranje, pregled) kontrole (vlastito rješenje, pojedinačno za
svaku tablicu) nad svim podacima u sustavu. Također ima mogućnost uvida u dnevnik
rada sustava (pogledati točku 9) kao i pretraživanje istog prema datumu i vremenu
(vremensko razdoblje od-do), tipu zapisa u dnevniku i korisniku. Administrator vidi
popis blokiranih korisnika i može odabranog korisnika deblokirati. Administrator
može resetirati uvjete korištenje te se time svim korisnicima javlja opet poruka o
prihvaćanju uvjeta korištenja (točka 1). Administrator ima mogućnosti konfiguriranja
aplikacije (npr. trajanje kolačića, broj redaka za straničenje, trajanje sesije, broj
neuspješnih prijava i sl.). Aplikacija postaje nedostupna svim korisnicima sve dok
administrator ne završi s promjenom konfiguracije (točka 11).

- [ ] 6. **Straničenje** - svaki ispis podataka s više od 5 elemenata mora imati straničenje.
Poželjno je da se broj elemenata po stranici može konfigurirati putem uloge
administratora.

- [ ] 7. **Statistika** - sve statistike moraju imati pregled za ispis, s gumbom za print (koji otvara
dijaloški okvir za ispis u web pregledniku) i gumb za generiranje PDF dokumenta (za
dodatne bodove). Sve statistike koje se prikazuju moraju imati mogućnost sortiranja
po prikazanim stupcima (minimalno 2 stupca). Obavezno prikazivanje statističkih
podataka u obliku barem jedne vrste grafa (prema odabiru). Zabranjeno je korištenje
gotovih rješenja (PHP i JavaScript). Obavezno je korištenje JavaScript-a i Canvas-a.
Moguće je koristiti i AJAX.

- [x] 8. **Relativne putanje** - rješenje projekta mora koristiti relativne putanje.

- [ ] 9. **Dnevnik rada** - svaki zahtjev treba biti upisan u dnevnik rada (tzv. log aplikacije): tko,
kada, što je radio i slično. Obavezno zapisivanje osnovnih informacija o radu sustava u
dnevnik rada: tip prijava/odjava (korisnik, vrijeme), tip rad s bazom (korisnik, upit,
vrijeme), tip ostale radnje (korisnik, vrijeme, radnja). Administrator može pogledati u
traženom razdoblju razne izvještaje (kronologija rada svih korisnika ili izabranog
korisnika, frekvencija rada korisnika i sl.)

- [ ] 10.** Pretraživanje i sortiranje** - svaki tablični prikaz mora imati omogućeno pretraživanje i
sortiranje po minimalno dva stupca.

- [ ] 11.** Dizajn** - administrator može urediti dizajn učitavanjem nove CSS datoteke (postojeća
se prepisuje) ili ažurirati trenutne CSS upute. Aplikacija postaje nedostupna svim
korisnicima sve dok administrator ne završi s uređivanjem dizajna. Svaka akcija
preusmjeruje na stranicu koja javlja poruku “U izradi”. Nakon pohrane primijenit će se
novi dizajn i aplikacije postaje ponovo dostupna!

- [ ] 12.** Poboljšanje korisničkog iskustva** - administrator kreira popis kolačića (min. 3) i
određuje za što se sve koriste u projektu (npr. unaprijed popunjeni obrazac, redoslijed
prikazivanja elemenata, rezultati prethodnog pretraživanja, zapamćen redoslijed
sortiranja, označavanje tablice, …). Korisnik vidi popis kolačića sa opisom i može
potvrditi/odbiti korištenje iste. Određena funkcionalnost u projektu neće raditi tako
dugo dok se kolačići ponovo ne dozvole.

## Opće upute

- [ ] 13. **Autentikacija** - treba biti provedena vlastitom metodom s bazom podataka. Potrebna
je validacija/provjera podataka na korisničkoj i poslužiteljskoj strani. Treba osigurati
zaštitu od automata prilikom registracije korisnika. Poželjno je da se pamte podaci
zadnje uspješne prijave (korisničko ime). Detaljnije upute o prijavi opisane su u točki
2.

- [x] 14. **Lozinke** - potrebno je sve lozinke u bazu podataka spremati u dva stupca. Prvi u
čitljivom obliku i drugi u kriptiranom obliku korištenjem SHA256 algoritma za
izračunavanja sažetka (eng. hash) i primjenom dinamičke (različita za svakog
korisnika) soli (eng. salt). Čitljiv oblik se koristi samo iz praktičnih razloga za vrijeme
obrane projekta ako se zaboravi lozinka. Provjera se mora vršiti sa zaštićenom
lozinkom.

- [ ] 15. **HTTPS** - stranica prijave mora ići preko sigurne linije tj. preko HTTPS protokola
uključujući kada se radi URL manipulacija (namjerna promjena HTTPS protokola u
HTTP protokol). Ostatak projekta ne mora biti preko HTTPS-a.

- [ ] 16. **Zaštita XSS i SQL ubacivanje (eng. SQL inject)** - napravite osnovu zaštitu u cijelom
projektu za XSS koristeći funkcije filter_input kod unosa i htmlspecialchars kod ispisa
te zaštitu protiv SQL ubacivanja korištenjem pripremljenih upita (eng. prepare
statements).

- [ ] 17. **Korisničko sučelje** - treba biti realizirano uz pomoć AJAX-a koji će preuzimati podatke
s poslužitelja (preporučujemo XML ili JSON, varijanta s HTML-om donosi manje
bodova). jQuery može se koristiti kod određenih dijelova projekta, veće korištenje
donosi više bodova. Za preglede kataloga podataka i ostale preglede potrebno je
primjenjivati straničenje (pogledaj točku 6). Poželjna je personalizacija i
pomoć/olakšanje rada korisnika upotrebom kolačića i JavaScripta.

- [ ] 18. **Podaci u bazi podataka** - glavni katalozi podataka (npr. korisnici, obiteljska stabla,
nekretnine, vozila, dijelovi, oprema i sl.) trebaju sadržavati više od 10 pojedinačnih
elemenata. Ostale tablice podataka trebaju imati više 20 pojedinačnih elemenata.

- [ ] 19. **Virtualno vrijeme** - rad aplikacije temelji se na virtualnom vremenu koje polazi od
stvarnog vremena na poslužitelju koje se korigira za određeni pomak vremena.
Jedinica vremena kod pomaka je 1 sat. Administrator aplikacije jedini može obaviti
usklađivanje vremena kojeg dohvaća sa servisa. Ako treba pomaknuti vrijeme za 7
dana naprijed (budućnost) tada je pomak 168 sati. Kod pomaka u nazad za 7 dana
(prošlost) vrijednost pomaka je -168 sati. Nakon što administrator obavi usklađivanje
vremena sa servisa u lokalnu konfiguraciju, sve aktivnosti vežu se uz novo virtualno
vrijeme i ne koristi se izravno servis već lokalna konfiguracija (kako studenti
međusobno ne bi mijenjali pomak vremena). Preporučuje se posebna funkcija kojom
će se dobivati virtualno vrijeme i koja će se koristiti kod svih vremenskih
uspoređivanja. Redoslijed koraka je sljedeći:
    1. podešavanje pomaka vremena obavlja se upisom adrese:
    http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html. Administrator ne
    može ručno raditi podešavanje pomaka vremena u konfiguraciji aplikacije.
    Obavezno treba koristiti sučelje servisa!
    2. preuzimanje pomaka vremena obavlja se čitanjem podataka s adrese:
    http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=xml ili
    http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json. To je
    XML ili JSON datoteka jednostavne strukture. Preuzimanje podataka za pomak
    vremena treba obaviti prema XML ili JSON formatu, a zatim aplikacija treba
    spremiti pomak vremena, u bazu podataka ili datoteku. To se obavlja samo po
    zahtjevu administratora.
    3. nakon preuzimanja aplikacije treba spremiti pomak vremena u lokalnu
    konfiguraciju (u bazu podataka ili datoteku). To se obavlja samo po zahtjevu
    administratora.
    4. korištenje virtualnog vremena temeljem lokalne konfiguracije (baza ili
    datoteka).

- [x] 20. **Instalacija** - rješenje treba biti instalirano na računalu barka.foi.hr. Pristup ostalim
studentima treba biti zabranjen.

- [x] 21. **Podaci** - se pohranjuju u MySQL bazu podataka pod nazivom WebDiP2021xnn (nn je
broj studenta 01 <= nn <= 300). Za studente će biti kreirane potrebne baze podataka i
dodijeljene potrebne dozvole (privilegije) za rad s bazom podataka. Studenti će dobiti
potrebne informacije za bazu podataka.

- [x] 22. **Direktorij** - na kojem je smješteno projektno rješenje treba biti WebDiP2021xnn (nn
je broj studenta 01 <= nn <= 300) u direktoriju /var/www/WebDiP/2021_projekti.
Studenti će dobiti poruku s potrebnim informacijama za pohranu projektnog rješenja.
Na direktoriju projektnog rješenja smiju se nalaziti samo skripte i ostali podaci vezani
uz projektno rješenje.

- [ ] 23. **Direktorij privatno** - treba biti zaštićen .htaccess datotekom pri čemu u njoj treba
postojati korisnik s istim korisničkim imenom i lozinkom kao i pristup do baze
podataka (pogledaj točku 22). 
> Skripta privatno/korisnici.php treba ispisati sve korisnike, njihove lozinke u čitljivom obliku i vrstu. Pristup do
> skripte nije ograničen na korisnike aplikacije.

- [x] 24. **Dokumentacija** - naziv datoteke treba biti dokumentacija.html i njoj se pristupa iz
početne stranice projektnog rješenja. Dokumentacija projektnog rješenja sastoji se
od:
    a. opis projektnog zadatka
    b. opis projektnog rješenja
    c. bitne odrednice projektnog rješenja (ERA model)
    d. popis i opis skripata, mapa mjesta, navigacijski dijagram
    e. popis i opis korištenih tehnologija i alata
    f. popis i opis vanjskih (tuđih) modula/biblioteka i njihovo korištenje u skriptama i sl.

- [x] 25. **O autoru** - naziv datoteke treba biti o_autoru.html i njoj se pristupa s početne
stranice projektnog rješenja. Stranica mora imati sliku (kao na osobnoj iskaznici), ime,
prezime, broj iksice i mail (s poveznicom koji otvara slanje maila). Ostatak stranice
sadrži podatke prema želji.


