# PolyPress
Malé CMS, postavené na Nette

## Primární cíle
1/ zrychlit výrobu jednoduchého webu  
2/ přenést váhu s výrobou na redaktora (a nejsou-li šablony, tak na kodéra)  
3/ vyhnout se vytváření presenterům prio každou stránku ``ONasPresenter``, ``KontaktPresenter``  

## Instalace PolyPressu
- ```git clone https://github.com/PolywebCZ/polypress.git```   
- přejmenovat ```App/Config/config.local.neon.disc``` na ```App/Config/config.local.neon``` a doplnit údaje pro databázi
- ```composer update```
- ```php www/index.php orm:generate-proxies```  
- ```php www/index.php orm:schema-tool:update --force```  

## Základní struktura aplikace
```
PolyPress/
├── App/                             ← adresář s aplikací
│   ├── AdminModule/                 ← CMS administrace
│   │   └── ...
│   ├── Commands/                    ← příkazy pro konzoli, například vytvoření uživatelů
│   ├── Config/                      ← konfigurační soubory
│   │   ├── config.neon              ← konfigurační soubor
│   │   └── config.local.neon
│   ├── Forms/                       ← třídy formulářů
│   ├── Presenters/                  ← třídy presenterů - společných pro všechny vzhledy
│   │   ├── HomepagePresenter.php    ← třída presenteru Homepage
│   ├── Router/                      ← třídy routerů
│   ├── Templates/                   ← adresář se vzhledy
│   │   └── Default                  ← jeden ze vzhledů, Default je výchozí
│   │       ├── @layout.latte        ← šablona společného layoutu pro tento vzhled
│   │       └── Homepage/            ← šablony presenteru Homepage
│   │           ├── @layout.latte    ← šablona akce default
│   │           └── config.neon      ← neon tohoto vzhledu (například pro webloader)
│   └── bootstrap.php                ← zaváděcí soubor aplikace
├── Libs/                            ← modelová vrstva a její třídy
├── log/                             ← obsahuje logy, error logy atd.
├── temp/                            ← pro dočasné soubory, cache, ...
├── tests/                           ← testy
├── vendor/                          ← adresář na knihovny (např. třetích stran)
│   ├── ...
│   └── autoload.php                 ← soubor který se stará o načítání tříd nainstalovaných balíčků
└── www/                             ← veřejný adresář, document root projektu
    ├── .htaccess                    ← pravidla pro mod_rewrite
    ├── index.php                    ← který spouští aplikaci
    │   └── templates/               ← adresář se vzhledy
    │       └── default              ← složka se vzhledem, default je výchozí, jediný dodávaný v systému
    │           ├── images/          ← další adresáře, třeba pro obrázky
    │           ├── webtemp/         ← adresář pro sloučené a minifikované css a js
    │           └── favicon.ico      ← ikona pro tento vzhled
    └── images/                      ← další adresáře, třeba pro obrázky společné napříč vzhledy
```
 