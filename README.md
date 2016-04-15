# PolyPress
Malé CMS, postavené na Nette

## Primární cíle
1/ umožnit výrobu webu v nette kodérovi  
2/ vyhnout se vytváření presenterům prio každou stránku ``ONasPresenter``, ``KontaktPresenter``  
3/ ...  

## Základní struktura aplikace
```
polypress/
├── App/                             ← adresář s aplikací
│   ├── Admin/                       ← CMS administrace
│   │   └── ...
│   ├── Config/                      ← konfigurační soubory
│   │   ├── config.neon              ← konfigurační soubor
│   │   └── config.local.neon
│   ├── Forms/                       ← třídy formulářů
│   ├── Presenters/                  ← třídy presenterů
│   │   ├── HomepagePresenter.php    ← třída presenteru Homepage
│   ├── Templates/                   ← adresář se vzhledy
│   │   └── Default                  ← jeden ze vzhledů, Default je výchozí
│   │       ├── @layout.latte        ← šablona společného layoutu pro tento vzhled
│   │       └── Homepage/            ← šablony presenteru Homepage
│   │           └── default.latte    ← šablona akce default
│   ├── Router/                      ← třídy routerů
│   └── bootstrap.php                ← zaváděcí soubor aplikace
├── Libs/                            ← modelová vrstva a její třídy
├── log/                             ← obsahuje logy, error logy atd.
├── temp/                            ← pro dočasné soubory, cache, ...
├── vendor/                          ← adresář na knihovny (např. třetích stran)
│   ├── nette/                       ← všechny knihovny Nette Frameworku
│   │   └── nette/Nette              ← oblíbený framework nainstalovaný Composerem
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
