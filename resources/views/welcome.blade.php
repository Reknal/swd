<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.css">


        <script src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.13.1/lodash.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
        <script type="text/javascript">

          $( document ).ready(function() {
                  $('.selectpicker').selectpicker({
                  });
          });

        </script>



        <script>
            var app = angular.module('app',[], function($interpolateProvider) {
                $interpolateProvider.startSymbol('{[{');
                $interpolateProvider.endSymbol('}]}');
            });

            app.controller('MainController', ['$scope', '$http', '$timeout', function($scope,  $http, $timeout) {
              $scope.wszystkieProdukty = [];
              $scope.wybraneProdukty = [];
              $scope.produktyDoWziecia = [];
              $scope.pierwszeSprawdzenie = false;
              $scope.cities = [{"id":1,"miasto":"Aleksandr\u00f3w Kujawski"},{"id":2,"miasto":"Andrych\u00f3w"},{"id":3,"miasto":"August\u00f3w"},{"id":4,"miasto":"Barlinek"},{"id":5,"miasto":"Bartoszyce"},{"id":6,"miasto":"B\u0119dzin"},{"id":7,"miasto":"Be\u0142chat\u00f3w"},{"id":8,"miasto":"Be\u0142\u017cyce"},{"id":9,"miasto":"Bia\u0142a Podlaska"},{"id":10,"miasto":"Bia\u0142ogard"},{"id":11,"miasto":"Bia\u0142ystok"},{"id":12,"miasto":"Bielawa"},{"id":13,"miasto":"Bielsko-Bia\u0142a"},{"id":14,"miasto":"Bielsk Podlaski"},{"id":15,"miasto":"Bieru\u0144 L\u0119dziny"},{"id":16,"miasto":"Bierut\u00f3w"},{"id":17,"miasto":"Bi\u0142goraj"},{"id":18,"miasto":"Biskupiec"},{"id":19,"miasto":"Blachownia"},{"id":20,"miasto":"B\u0142onie"},{"id":21,"miasto":"Bochnia"},{"id":22,"miasto":"Bogatynia"},{"id":23,"miasto":"Bogusz\u00f3w-Gorce"},{"id":24,"miasto":"Boles\u0142awiec"},{"id":25,"miasto":"Bolk\u00f3w"},{"id":26,"miasto":"Braniewo"},{"id":27,"miasto":"Brodnica"},{"id":28,"miasto":"Brwin\u00f3w"},{"id":29,"miasto":"Brzeg"},{"id":30,"miasto":"Brzeg Dolny"},{"id":31,"miasto":"Brzesko"},{"id":32,"miasto":"Brzeszcze"},{"id":33,"miasto":"Brzeziny"},{"id":34,"miasto":"Brzoz\u00f3w"},{"id":35,"miasto":"Bukowno"},{"id":36,"miasto":"Busko-Zdr\u00f3j"},{"id":37,"miasto":"Bychawa"},{"id":38,"miasto":"Bydgoszcz"},{"id":39,"miasto":"Bystrzyca K\u0142odzka"},{"id":40,"miasto":"Bytom"},{"id":41,"miasto":"Byt\u00f3w"},{"id":42,"miasto":"Che\u0142m"},{"id":43,"miasto":"Che\u0142mek"},{"id":44,"miasto":"Che\u0142mno"},{"id":45,"miasto":"Che\u0142m\u017ca"},{"id":46,"miasto":"Chocian\u00f3w"},{"id":47,"miasto":"Chodzie\u017c"},{"id":48,"miasto":"Chojnice"},{"id":49,"miasto":"Chojn\u00f3w"},{"id":50,"miasto":"Chorz\u00f3w"},{"id":51,"miasto":"Choszczno"},{"id":52,"miasto":"Chrzan\u00f3w"},{"id":53,"miasto":"Ciechan\u00f3w"},{"id":54,"miasto":"Ciechocinek"},{"id":55,"miasto":"Cieszyn"},{"id":56,"miasto":"Czarne"},{"id":57,"miasto":"Czarnk\u00f3w"},{"id":58,"miasto":"Czechowice-Dziedzice"},{"id":59,"miasto":"Czelad\u017a"},{"id":60,"miasto":"Czersk"},{"id":61,"miasto":"Czerwionka-Leszczyny"},{"id":62,"miasto":"Cz\u0119stochowa"},{"id":63,"miasto":"Cz\u0142uch\u00f3w"},{"id":64,"miasto":"D\u0105browa G\u00f3rnicza"},{"id":65,"miasto":"D\u0105browa Tarnowska"},{"id":66,"miasto":"Dar\u0142owo"},{"id":67,"miasto":"D\u0119bica"},{"id":68,"miasto":"D\u0119bica"},{"id":69,"miasto":"D\u0119bno"},{"id":70,"miasto":"D\u0142ugo\u0142\u0119ka"},{"id":71,"miasto":"Dobre Miasto"},{"id":72,"miasto":"Drawsko-Pomorskie"},{"id":73,"miasto":"Drezdenko"},{"id":74,"miasto":"Duszniki-Zdr\u00f3j"},{"id":75,"miasto":"Dzia\u0142dowo"},{"id":76,"miasto":"Dzia\u0142oszyn"},{"id":77,"miasto":"Dzierzgo\u0144"},{"id":78,"miasto":"Dzier\u017coni\u00f3w"},{"id":79,"miasto":"Elbl\u0105g"},{"id":80,"miasto":"E\u0142k"},{"id":81,"miasto":"Garwolin"},{"id":82,"miasto":"Gda\u0144sk"},{"id":83,"miasto":"Gdynia"},{"id":84,"miasto":"Gi\u017cycko"},{"id":85,"miasto":"Gliwice"},{"id":86,"miasto":"G\u0142og\u00f3w"},{"id":87,"miasto":"G\u0142owno"},{"id":88,"miasto":"G\u0142ubczyce"},{"id":89,"miasto":"G\u0142ucho\u0142azy"},{"id":90,"miasto":"G\u0142uszyca"},{"id":91,"miasto":"Gniew"},{"id":92,"miasto":"Gniezno"},{"id":93,"miasto":"Goerlitz"},{"id":94,"miasto":"Go\u0142dap"},{"id":95,"miasto":"Goleni\u00f3w"},{"id":96,"miasto":"Golub-Dobrzy\u0144"},{"id":97,"miasto":"G\u00f3ra"},{"id":98,"miasto":"G\u00f3ra Kalwaria"},{"id":99,"miasto":"Gorlice"},{"id":100,"miasto":"Gorz\u00f3w Wielkopolski"},{"id":101,"miasto":"Gosty\u0144"},{"id":102,"miasto":"Gostynin"},{"id":103,"miasto":"Grajewo"},{"id":104,"miasto":"Grodzisk Wielkopolski"},{"id":105,"miasto":"Grodzisk Mazowiecki"},{"id":106,"miasto":"Gr\u00f3jec"},{"id":107,"miasto":"Grudzi\u0105dz"},{"id":108,"miasto":"Gryfice"},{"id":109,"miasto":"Gryfino"},{"id":110,"miasto":"Gryf\u00f3w \u015al\u0105ski"},{"id":111,"miasto":"Gubin"},{"id":112,"miasto":"Hajn\u00f3wka"},{"id":113,"miasto":"Hel"},{"id":114,"miasto":"Hrubiesz\u00f3w"},{"id":115,"miasto":"I\u0142awa"},{"id":116,"miasto":"Imielin"},{"id":117,"miasto":"Inowroc\u0142aw"},{"id":118,"miasto":"Jan\u00f3w Lubelski"},{"id":119,"miasto":"Jarocin"},{"id":120,"miasto":"Jaros\u0142aw"},{"id":121,"miasto":"Jas\u0142o"},{"id":122,"miasto":"Jastrowie"},{"id":123,"miasto":"Jastrz\u0119bie-Zdr\u00f3j"},{"id":124,"miasto":"Jawor"},{"id":125,"miasto":"Jaworzno"},{"id":126,"miasto":"J\u0119drzej\u00f3w"},{"id":127,"miasto":"Jelcz-Laskowice"},{"id":128,"miasto":"Jelenia G\u00f3ra"},{"id":129,"miasto":"J\u00f3zef\u00f3w"},{"id":130,"miasto":"Kalety"},{"id":131,"miasto":"Kalisz"},{"id":132,"miasto":"Kamienna G\u00f3ra"},{"id":133,"miasto":"Karczew"},{"id":134,"miasto":"Karpacz"},{"id":135,"miasto":"Kartuzy"},{"id":136,"miasto":"Katowice"},{"id":137,"miasto":"K\u0105ty Wroc\u0142awskie"},{"id":138,"miasto":"Kazimierz Dolny"},{"id":139,"miasto":"K\u0119dzierzyn-Ko\u017ale"},{"id":140,"miasto":"K\u0119pno"},{"id":141,"miasto":"K\u0119trzyn"},{"id":142,"miasto":"K\u0119ty"},{"id":143,"miasto":"Kielce"},{"id":144,"miasto":"K\u0142obuck"},{"id":145,"miasto":"K\u0142odawa"},{"id":146,"miasto":"K\u0142odzko"},{"id":147,"miasto":"Kluczbork"},{"id":148,"miasto":"Knur\u00f3w"},{"id":149,"miasto":"Koby\u0142ka"},{"id":150,"miasto":"Kolbuszowa"},{"id":151,"miasto":"Kolno"},{"id":152,"miasto":"Ko\u0142o"},{"id":153,"miasto":"Ko\u0142obrzeg"},{"id":154,"miasto":"Koluszki"},{"id":155,"miasto":"Koniecpol"},{"id":156,"miasto":"Konin"},{"id":157,"miasto":"Ko\u0144skie"},{"id":158,"miasto":"Konstancin-Jeziorna"},{"id":159,"miasto":"K\u00f3rnik"},{"id":160,"miasto":"Koronowo"},{"id":161,"miasto":"Ko\u015bcian"},{"id":162,"miasto":"Ko\u015bcierzyna"},{"id":163,"miasto":"Kostrzyn"},{"id":164,"miasto":"Kostrzyn nad Odr\u0105"},{"id":165,"miasto":"Koszalin"},{"id":166,"miasto":"Kowary"},{"id":167,"miasto":"Kozienice"},{"id":168,"miasto":"Kozy"},{"id":169,"miasto":"Krak\u00f3w"},{"id":170,"miasto":"Krapkowice"},{"id":171,"miasto":"Kra\u015bnik"},{"id":172,"miasto":"Krasnystaw"},{"id":173,"miasto":"Krosno"},{"id":174,"miasto":"Krosno Odrza\u0144skie"},{"id":175,"miasto":"Krotoszyn"},{"id":176,"miasto":"Krynica"},{"id":177,"miasto":"Krynica Morska"},{"id":178,"miasto":"Krzepice"},{"id":179,"miasto":"Krzeszowice"},{"id":180,"miasto":"Kudowa-Zdr\u00f3j"},{"id":181,"miasto":"Kutno"},{"id":182,"miasto":"Kwidzyn"},{"id":183,"miasto":"L\u0105dek-Zdr\u00f3j"},{"id":184,"miasto":"L\u0119bork"},{"id":185,"miasto":"L\u0119dziny"},{"id":186,"miasto":"Legionowo"},{"id":187,"miasto":"Legnica"},{"id":188,"miasto":"Leszno"},{"id":189,"miasto":"Le\u017cajsk"},{"id":190,"miasto":"Libi\u0105\u017c"},{"id":191,"miasto":"Lidzbark"},{"id":192,"miasto":"Lidzbark Warmi\u0144ski"},{"id":193,"miasto":"Limanowa"},{"id":194,"miasto":"Lipno"},{"id":195,"miasto":"Lubacz\u00f3w"},{"id":196,"miasto":"Luba\u0144"},{"id":197,"miasto":"Lubart\u00f3w"},{"id":198,"miasto":"Lubawa"},{"id":199,"miasto":"Lubawka"},{"id":200,"miasto":"Lubin"},{"id":201,"miasto":"Lublin"},{"id":202,"miasto":"Lubliniec"},{"id":203,"miasto":"Lubo\u0144"},{"id":204,"miasto":"Lubsko"},{"id":205,"miasto":"Lw\u00f3wek \u015al\u0105ski"},{"id":206,"miasto":"\u0141a\u0144cut"},{"id":207,"miasto":"\u0141apy"},{"id":208,"miasto":"\u0141ask"},{"id":209,"miasto":"\u0141aziska G\u00f3rne"},{"id":210,"miasto":"\u0141azy"},{"id":211,"miasto":"\u0141eba"},{"id":212,"miasto":"\u0141\u0119czna"},{"id":213,"miasto":"\u0141\u0119czyca"},{"id":214,"miasto":"\u0141obez"},{"id":215,"miasto":"\u0141\u00f3d\u017a"},{"id":216,"miasto":"\u0141omianki"},{"id":217,"miasto":"\u0141om\u017ca"},{"id":218,"miasto":"\u0141owicz"},{"id":219,"miasto":"\u0141uk\u00f3w"},{"id":220,"miasto":"Mak\u00f3w Mazowiecki"},{"id":221,"miasto":"Mak\u00f3w Podhala\u0144ski"},{"id":222,"miasto":"Malbork"},{"id":223,"miasto":"Marki"},{"id":224,"miasto":"Miasteczko \u015al\u0105skie"},{"id":225,"miasto":"Miastko"},{"id":226,"miasto":"Miech\u00f3w"},{"id":227,"miasto":"Mi\u0119dzych\u00f3d"},{"id":228,"miasto":"Mi\u0119dzyrzecz"},{"id":229,"miasto":"Mielec"},{"id":230,"miasto":"Miko\u0142\u00f3w"},{"id":231,"miasto":"Milan\u00f3wek"},{"id":232,"miasto":"Milicz"},{"id":233,"miasto":"Mi\u0144sk Mazowiecki"},{"id":234,"miasto":"Mogilno"},{"id":235,"miasto":"Mo\u0144ki"},{"id":236,"miasto":"Mor\u0105g"},{"id":237,"miasto":"Mosina"},{"id":238,"miasto":"Mr\u0105gowo"},{"id":239,"miasto":"Mszana Dolna"},{"id":240,"miasto":"Murowana Go\u015blina"},{"id":241,"miasto":"My\u015blenice"},{"id":242,"miasto":"My\u015blib\u00f3rz"},{"id":243,"miasto":"Mys\u0142owice"},{"id":244,"miasto":"Myszk\u00f3w"},{"id":245,"miasto":"Nak\u0142o nad Noteci\u0105"},{"id":246,"miasto":"Namys\u0142\u00f3w"},{"id":247,"miasto":"Nasielsk"},{"id":248,"miasto":"Nidzica"},{"id":249,"miasto":"Niepo\u0142omice"},{"id":250,"miasto":"Nisko"},{"id":251,"miasto":"Nowa D\u0119ba"},{"id":252,"miasto":"Nowa Ruda"},{"id":253,"miasto":"Nowa S\u00f3l"},{"id":254,"miasto":"Nowe Miasto Lubawskie"},{"id":255,"miasto":"Nowogard"},{"id":256,"miasto":"Nowy Dw\u00f3r Gda\u0144ski"},{"id":257,"miasto":"Nowy Dw\u00f3r Mazowiecki"},{"id":258,"miasto":"Nowy S\u0105cz"},{"id":259,"miasto":"Nowy Targ"},{"id":260,"miasto":"Nowy Tomy\u015bl"},{"id":261,"miasto":"Nysa"},{"id":262,"miasto":"Oborniki"},{"id":263,"miasto":"Oborniki \u015al\u0105skie"},{"id":264,"miasto":"Ogrodzieniec"},{"id":265,"miasto":"O\u0142awa"},{"id":266,"miasto":"Olecko"},{"id":267,"miasto":"Ole\u015bnica"},{"id":268,"miasto":"Olkusz"},{"id":269,"miasto":"Olsztyn"},{"id":270,"miasto":"Olsztynek"},{"id":271,"miasto":"Opalenica"},{"id":272,"miasto":"Opoczno"},{"id":273,"miasto":"Opole"},{"id":274,"miasto":"Opole Lubelskie"},{"id":275,"miasto":"Orneta"},{"id":276,"miasto":"Orzesze"},{"id":277,"miasto":"Ostr\u00f3da"},{"id":278,"miasto":"Ostro\u0142\u0119ka"},{"id":279,"miasto":"Ostr\u00f3w Wielkopolski"},{"id":280,"miasto":"Ostrowiec \u015awi\u0119tokrzyski"},{"id":281,"miasto":"Ostrzesz\u00f3w"},{"id":282,"miasto":"O\u015bwi\u0119cim"},{"id":283,"miasto":"Otwock"},{"id":284,"miasto":"Pabianice"},{"id":285,"miasto":"Paj\u0119czno"},{"id":286,"miasto":"Parczew"},{"id":287,"miasto":"Pas\u0142\u0119k"},{"id":288,"miasto":"Pelplin"},{"id":289,"miasto":"Piaseczno"},{"id":290,"miasto":"Piechowice"},{"id":291,"miasto":"Piekary \u015al\u0105skie"},{"id":292,"miasto":"Pie\u0144sk"},{"id":293,"miasto":"Pieszyce"},{"id":294,"miasto":"Pi\u0142a"},{"id":295,"miasto":"Pi\u0142awa G\u00f3rna"},{"id":296,"miasto":"Pi\u0144cz\u00f3w"},{"id":297,"miasto":"Pionki"},{"id":298,"miasto":"Piotrk\u00f3w Trybunalski"},{"id":299,"miasto":"Pisz"},{"id":300,"miasto":"Pleszew"},{"id":301,"miasto":"P\u0142ock"},{"id":302,"miasto":"P\u0142o\u0144sk"},{"id":303,"miasto":"Pniewy"},{"id":304,"miasto":"Pobiedziska"},{"id":305,"miasto":"Podd\u0119bice"},{"id":306,"miasto":"Polanica-Zdr\u00f3j"},{"id":307,"miasto":"Police"},{"id":308,"miasto":"Polkowice"},{"id":309,"miasto":"Poniatowa"},{"id":310,"miasto":"Por\u0119ba"},{"id":311,"miasto":"Pozna\u0144"},{"id":312,"miasto":"Prabuty"},{"id":313,"miasto":"Proszowice"},{"id":314,"miasto":"Prudnik"},{"id":315,"miasto":"Pruszcz Gda\u0144ski"},{"id":316,"miasto":"Pruszk\u00f3w"},{"id":317,"miasto":"Przasnysz"},{"id":318,"miasto":"Przemk\u00f3w"},{"id":319,"miasto":"Przemy\u015bl"},{"id":320,"miasto":"Przeworsk"},{"id":321,"miasto":"Przysucha"},{"id":322,"miasto":"Pszczyna"},{"id":323,"miasto":"Psz\u00f3w"},{"id":324,"miasto":"Puck"},{"id":325,"miasto":"Pu\u0142awy"},{"id":326,"miasto":"Pu\u0142tusk"},{"id":327,"miasto":"Pyrzyce"},{"id":328,"miasto":"Pyskowice"},{"id":329,"miasto":"Rabka-Zdr\u00f3j"},{"id":330,"miasto":"Racib\u00f3rz"},{"id":331,"miasto":"Radlin"},{"id":332,"miasto":"Radom"},{"id":333,"miasto":"Radomsko"},{"id":334,"miasto":"Radzionk\u00f3w"},{"id":335,"miasto":"Radzymin"},{"id":336,"miasto":"Radzy\u0144 Podlaski"},{"id":337,"miasto":"Rawa Mazowiecka"},{"id":338,"miasto":"Rawicz"},{"id":339,"miasto":"Reda"},{"id":340,"miasto":"Rogo\u017ano"},{"id":341,"miasto":"Ropczyce"},{"id":342,"miasto":"Ruda \u015al\u0105ska"},{"id":343,"miasto":"Rudnik nad Sanem"},{"id":344,"miasto":"Rumia"},{"id":345,"miasto":"Rybnik"},{"id":346,"miasto":"Rydu\u0142towy"},{"id":347,"miasto":"Ryki"},{"id":348,"miasto":"Rypin"},{"id":349,"miasto":"Rzesz\u00f3w"},{"id":350,"miasto":"Sandomierz"},{"id":351,"miasto":"Sanok"},{"id":352,"miasto":"S\u0119dzisz\u00f3w Ma\u0142opolski"},{"id":353,"miasto":"Siechnice"},{"id":354,"miasto":"Siedlce"},{"id":355,"miasto":"Siemianowice \u015al\u0105skie"},{"id":356,"miasto":"Siemiatycze"},{"id":357,"miasto":"Sieradz"},{"id":358,"miasto":"Sierpc"},{"id":359,"miasto":"Siewierz"},{"id":360,"miasto":"Skarszewy"},{"id":361,"miasto":"Skar\u017cysko-Kamienna"},{"id":362,"miasto":"Skawina"},{"id":363,"miasto":"Skierniewice"},{"id":364,"miasto":"Skocz\u00f3w"},{"id":365,"miasto":"Skwierzyna"},{"id":366,"miasto":"S\u0142awk\u00f3w"},{"id":367,"miasto":"S\u0142awno"},{"id":368,"miasto":"S\u0142ubice"},{"id":369,"miasto":"S\u0142upca"},{"id":370,"miasto":"S\u0142upsk"},{"id":371,"miasto":"Sob\u00f3tka"},{"id":372,"miasto":"Sochaczew"},{"id":373,"miasto":"Sok\u00f3\u0142ka"},{"id":374,"miasto":"Soko\u0142\u00f3w Podlaski"},{"id":375,"miasto":"Solec Kujawski"},{"id":376,"miasto":"Sopot"},{"id":377,"miasto":"Sosnowiec"},{"id":378,"miasto":"Stalowa Wola"},{"id":379,"miasto":"Starachowice"},{"id":380,"miasto":"Stargard"},{"id":381,"miasto":"Starogard Gda\u0144ski"},{"id":382,"miasto":"Stary S\u0105cz"},{"id":383,"miasto":"Stasz\u00f3w"},{"id":384,"miasto":"Stronie \u015al\u0105skie"},{"id":385,"miasto":"Strzegom"},{"id":386,"miasto":"Strzelce Kraje\u0144skie"},{"id":387,"miasto":"Strzelce Opolskie"},{"id":388,"miasto":"Strzelin"},{"id":389,"miasto":"Strzy\u017c\u00f3w"},{"id":390,"miasto":"Sucha Beskidzka"},{"id":391,"miasto":"Sulech\u00f3w"},{"id":392,"miasto":"Sul\u0119cin"},{"id":393,"miasto":"Sulej\u00f3w"},{"id":394,"miasto":"Sulej\u00f3wek"},{"id":395,"miasto":"Su\u0142kowice"},{"id":396,"miasto":"Suwa\u0142ki"},{"id":397,"miasto":"Swarz\u0119dz"},{"id":398,"miasto":"Syc\u00f3w"},{"id":399,"miasto":"Szamotu\u0142y"},{"id":400,"miasto":"Szczawnica"},{"id":401,"miasto":"Szczawno-Zdr\u00f3j"},{"id":402,"miasto":"Szczebrzeszyn"},{"id":403,"miasto":"Szczecin"},{"id":404,"miasto":"Szczecinek"},{"id":405,"miasto":"Szczekociny"},{"id":406,"miasto":"Szczyrk"},{"id":407,"miasto":"Szczytno"},{"id":408,"miasto":"Szklarska Por\u0119ba"},{"id":409,"miasto":"Szprotawa"},{"id":410,"miasto":"Sztum"},{"id":411,"miasto":"Szyd\u0142owiec"},{"id":412,"miasto":"\u015arem"},{"id":413,"miasto":"\u015aroda \u015al\u0105ska"},{"id":414,"miasto":"\u015aroda Wielkopolska"},{"id":415,"miasto":"\u015awidnica"},{"id":416,"miasto":"\u015awidnik"},{"id":417,"miasto":"\u015awidwin"},{"id":418,"miasto":"\u015awiebodzice"},{"id":419,"miasto":"\u015awiebodzin"},{"id":420,"miasto":"\u015awiecie"},{"id":421,"miasto":"\u015awierad\u00f3w-Zdr\u00f3j"},{"id":422,"miasto":"\u015awi\u0119toch\u0142owice"},{"id":423,"miasto":"\u015awinouj\u015bcie"},{"id":424,"miasto":"Tarnobrzeg"},{"id":425,"miasto":"Tarn\u00f3w"},{"id":426,"miasto":"Tarnowskie G\u00f3ry"},{"id":427,"miasto":"Tczew"},{"id":428,"miasto":"Terespol"},{"id":429,"miasto":"Tomasz\u00f3w Lubelski"},{"id":430,"miasto":"Tomasz\u00f3w Mazowiecki"},{"id":431,"miasto":"Toru\u0144"},{"id":432,"miasto":"Toszek"},{"id":433,"miasto":"Trzcianka"},{"id":434,"miasto":"Trzebiat\u00f3w"},{"id":435,"miasto":"Trzebinia"},{"id":436,"miasto":"Trzebnica"},{"id":437,"miasto":"Trzemeszno"},{"id":438,"miasto":"Tuchola"},{"id":439,"miasto":"Tuch\u00f3w"},{"id":440,"miasto":"Turek"},{"id":441,"miasto":"Tuszyn"},{"id":442,"miasto":"Twardog\u00f3ra"},{"id":443,"miasto":"Tychy"},{"id":444,"miasto":"Ustka"},{"id":445,"miasto":"Ustro\u0144"},{"id":446,"miasto":"Ustrzyki Dolne"},{"id":447,"miasto":"W\u0105brze\u017ano"},{"id":448,"miasto":"Wadowice"},{"id":449,"miasto":"W\u0105growiec"},{"id":450,"miasto":"Wa\u0142brzych"},{"id":451,"miasto":"Wa\u0142cz"},{"id":452,"miasto":"Warka"},{"id":453,"miasto":"Warszawa"},{"id":454,"miasto":"Wasilk\u00f3w"},{"id":455,"miasto":"W\u0119gorzewo"},{"id":456,"miasto":"W\u0119gr\u00f3w"},{"id":457,"miasto":"Wejherowo"},{"id":458,"miasto":"Wieliczka"},{"id":459,"miasto":"Wielu\u0144"},{"id":460,"miasto":"Wierusz\u00f3w"},{"id":461,"miasto":"Wis\u0142a"},{"id":462,"miasto":"Witkowo"},{"id":463,"miasto":"W\u0142adys\u0142awowo"},{"id":464,"miasto":"W\u0142oc\u0142awek"},{"id":465,"miasto":"W\u0142odawa"},{"id":466,"miasto":"W\u0142oszczowa"},{"id":467,"miasto":"Wodzis\u0142aw \u015al\u0105ski"},{"id":468,"miasto":"Wojkowice"},{"id":469,"miasto":"Wolbrom"},{"id":470,"miasto":"Wo\u0142omin"},{"id":471,"miasto":"Wo\u0142\u00f3w"},{"id":472,"miasto":"Wolsztyn"},{"id":473,"miasto":"Wo\u017aniki"},{"id":474,"miasto":"Wroc\u0142aw"},{"id":475,"miasto":"Wronki"},{"id":476,"miasto":"Wrze\u015bnia"},{"id":477,"miasto":"Wschowa"},{"id":478,"miasto":"Wyszk\u00f3w"},{"id":479,"miasto":"Z\u0105bkowice \u015al\u0105skie"},{"id":480,"miasto":"Zabrze"},{"id":481,"miasto":"Zakopane"},{"id":482,"miasto":"Zambr\u00f3w"},{"id":483,"miasto":"Zamo\u015b\u0107"},{"id":484,"miasto":"Zawiercie"},{"id":485,"miasto":"Zb\u0105szy\u0144"},{"id":486,"miasto":"Zdu\u0144ska Wola"},{"id":487,"miasto":"Zdzieszowice"},{"id":488,"miasto":"Zel\u00f3w"},{"id":489,"miasto":"Zgierz"},{"id":490,"miasto":"Zgorzelec"},{"id":491,"miasto":"Zi\u0119bice"},{"id":492,"miasto":"Zielona G\u00f3ra"},{"id":493,"miasto":"Zielonka"},{"id":494,"miasto":"Z\u0142ocieniec"},{"id":495,"miasto":"Z\u0142otoryja"},{"id":496,"miasto":"Z\u0142ot\u00f3w"},{"id":497,"miasto":"\u017baga\u0144"},{"id":498,"miasto":"\u017barki"},{"id":499,"miasto":"\u017bar\u00f3w"},{"id":500,"miasto":"\u017bary"},{"id":501,"miasto":"\u017bmigr\u00f3d"},{"id":502,"miasto":"\u017bnin"},{"id":503,"miasto":"\u017bory"},{"id":504,"miasto":"\u017bukowo"},{"id":505,"miasto":"\u017buromin"},{"id":506,"miasto":"\u017bychlin"},{"id":507,"miasto":"\u017byrard\u00f3w"},{"id":508,"miasto":"\u017bywiec"}];
              $scope.maksMasa = 50;
              $scope.maksObjetosc = 50;

              $scope.init = function(){
                $http({
                  method: 'GET',
                  url: '/getAllProducts'
                }).then(function successCallback(response) {
                   $scope.wszystkieProdukty = response.data;
                   window._.each($scope.wszystkieProdukty, function(produkt, indeks){
                    $scope.wszystkieProdukty[indeks].wartosc = parseFloat($scope.wszystkieProdukty[indeks].wartosc);
                    $scope.wszystkieProdukty[indeks].masa = parseFloat($scope.wszystkieProdukty[indeks].masa);
                    $scope.wszystkieProdukty[indeks].objetosc = parseFloat($scope.wszystkieProdukty[indeks].objetosc);
                   });
                });
              };

              $scope.dodajProdukt = function(produkt){
                var wybrany = _.filter($scope.wybraneProdukty, function(prod){ return prod.nazwa == produkt.nazwa; });
                if (wybrany.length == 0){
                  var nowyProdukt = window._.clone(produkt);
                  nowyProdukt.liczbaProduktow = 1;
                  $scope.wybraneProdukty.push(nowyProdukt);
                } else {
                  wybrany[0].liczbaProduktow ++;
                }
                window._.each($scope.wszystkieProdukty, function(prod, index){
                  if(prod.nazwa == produkt.nazwa){
                    $scope.wszystkieProdukty[index].liczbaProduktow -= 1;
                  }
                });
              };

              $scope.usunProdukt = function(produkt){
                window._.each($scope.wszystkieProdukty, function(prod, index){
                  if(prod.nazwa == produkt.nazwa){
                    $scope.wszystkieProdukty[index].liczbaProduktow ++;
                  }
                });
                window._.each($scope.wybraneProdukty, function(prod, index){
                  if(prod.nazwa == produkt.nazwa){
                    $scope.wybraneProdukty[index].liczbaProduktow --;
                    if($scope.wybraneProdukty[index].liczbaProduktow == 0){
                      $scope.wybraneProdukty = window._.filter($scope.wybraneProdukty, function(produ) {
                        return produ.nazwa != prod.nazwa;
                      });
                    }
                  }
                });
              };

              $scope.sprawdz = function(){
                $scope.listaWybranych = [];
                var drzewoWezly = [];
                var drzewoKrawedzie  = [];

                $scope.listaWybranych = stworzListeWybranych();

                drzewoWezly = stworzWezly($scope.listaWybranych.length);

                var temp1 = deepObjCopy(drzewoWezly);

                console.log('stan', temp1);

                drzewoKrawdzenie = stworzKrawedzie(drzewoWezly);

                var temp2 = deepObjCopy(drzewoKrawdzenie);
                console.log('krawedzie', temp2);

                dajProdukty(drzewoKrawdzenie);

              };

              var dajProdukty = function(krawedzie){
                var zapamietaneWartosci = [];
                var iterator = 0;

                for(var i = (krawedzie.length-1); i>=0; i--){
                  var u = _.groupBy(krawedzie[i], function(krawedz){
                    return krawedz.z;
                  });

                  // usuniecie u, ktore przekraczaja maks mase i objetosc
                  if (i == krawedzie.length-1){

                    window._.each(u, function(grupa, indeks){
                      u[indeks] = window._.filter(u[indeks], function(krawedz){
                        return $scope.maksMasa > krawedz.zmianaMasy && $scope.maksObjetosc > krawedz.zmianaObjetosci
                      });
                    });

                  } else {

                    // usuwamy krawedzie, ktore nie spelniaja ogarniczen

                    window._.each(u, function(grupa, indeks){
                      u[indeks] = window._.filter(u[indeks], function(krawedz){
                        var masaIObjetosc = dajMaseObjetoscWartoscZPoprzednichIteracji(krawedz, zapamietaneWartosci[iterator]);
                        return $scope.maksMasa > (krawedz.zmianaMasy+masaIObjetosc.masa) && $scope.maksObjetosc > (krawedz.zmianaObjetosci+masaIObjetosc.objetosc);
                      });
                    });


                    // dodawanie wartosci z poprzednich iteracji

                    window._.each(u, function(grupa, indeks1){
                      window._.each(grupa, function(krawedz, indeks2){
                        var masaObjetoscWartosc = dajMaseObjetoscWartoscZPoprzednichIteracji(krawedz, zapamietaneWartosci[iterator]);
                        u[indeks1][indeks2].wartosc = u[indeks1][indeks2].wartosc + masaObjetoscWartosc.wartosc;
                        u[indeks1][indeks2].zmianaMasy = u[indeks1][indeks2].zmianaMasy + masaObjetoscWartosc.masa;
                        u[indeks1][indeks2].zmianaObjetosci = u[indeks1][indeks2].zmianaObjetosci + masaObjetoscWartosc.objetosc;
                      });
                    });

                    iterator++;

                  }

                  // daj najwieksza wartosc z kazdej grupy
                  var vx = [];
                  window._.each(u, function(grupa){
                    var najwieksza = deepObjCopy(grupa[0]);
                    window._.each(grupa, function(krawedz){
                      if(najwieksza.wartosc<krawedz.wartosc){
                        najwieksza = deepObjCopy(krawedz);
                      }
                    });
                    vx.push(najwieksza);
                  });



                  zapamietaneWartosci.push(vx);

                  var temp3 = deepObjCopy(zapamietaneWartosci);
                  console.log('vx', temp3);

                }

                var przedmioty = [];
                var iterator = 0;

                $scope.produktyDoWziecia = znajdzElementSciezki(zapamietaneWartosci);

                console.log($scope.produktyDoWziecia);

                $scope.pierwszeSprawdzenie = true;

              };

              var znajdzElementSciezki = function(zapamietaneWartosci){
                var sciezka = [];
                var produkty = [];

                sciezka.push(zapamietaneWartosci[zapamietaneWartosci.length-1][0]);
                for(var i = 1; i<zapamietaneWartosci.length; i++){

                  for(var j =0; j<zapamietaneWartosci[zapamietaneWartosci.length-i-1].length;j++){
                    if(sprawdzCzySaToTeSameWartosci(sciezka[i-1].do, zapamietaneWartosci[zapamietaneWartosci.length-i-1][j].z)){
                      var scie = deepObjCopy(zapamietaneWartosci[zapamietaneWartosci.length-i-1][j]);
                      sciezka.push(scie);
                    }
                  }

                }

                console.log('sciezka', sciezka);

                for (var i =0; i<sciezka.length;i++){
                  if(sciezka[i].decyzja == 1){
                    produkty.push(znajdzRoznice(sciezka[i].z, sciezka[i].do));
                  }
                }

                return produkty;
              };

              var znajdzRoznice = function(z, doo){
                var z = deepObjCopy(z);
                var doo = deepObjCopy(doo);

                window._.each(z, function(id, index){
                  doo.splice(doo.indexOf(id), 1);
                });

                return window._.filter($scope.listaWybranych, function(prod){
                  return prod.id == doo[0];
                })[0];

              };

              var dajMaseObjetoscWartoscZPoprzednichIteracji = function(krawedz1, zapamietane){
                var szukanaKrawedz = null;
                window._.each(zapamietane, function(krawedz2, indeks1){
                    if(sprawdzCzySaToTeSameWartosci(krawedz1.do,krawedz2.z)){
                      szukanaKrawedz = krawedz2;
                    }
                });
                var masaObjetoscWartosc = {
                  wartosc: szukanaKrawedz.wartosc,
                  masa: szukanaKrawedz.zmianaMasy,
                  objetosc: szukanaKrawedz.zmianaObjetosci
                };
                return masaObjetoscWartosc;
              };

              var sprawdzCzySaToTeSameWartosci = function(tablica1, tablica2){
                var ile = 0;
                window._.each(tablica1, function(war1){
                  window._.each(tablica2, function(war2){
                    if(war1 == war2){
                      ile++;
                    }
                  });
                });
                if(ile == tablica1.length){
                  return true;
                } else {
                  return false;
                }
              };

              var stworzListeWybranych = function(){
                $scope.listaWybranych = [];
                var id = 0;
                window._.each($scope.wybraneProdukty, function(prod, index){
                  for(var i = 0; i < prod.liczbaProduktow; i++){
                    var nowyProdukt = window._.clone(prod);
                    delete nowyProdukt.liczbaProduktow;
                    nowyProdukt.id = id;
                    id++;
                    $scope.listaWybranych.push(nowyProdukt);
                  }
                });
                return $scope.listaWybranych;
              };

              var dajMaseWartoscObjetosc = function(z, od){
                var z = deepObjCopy(z);
                var od = deepObjCopy(od);
                window._.each(z, function(id, index){
                  od.splice(od.indexOf(id), 1);
                });
                var produkt = window._.filter($scope.listaWybranych, function(prod){
                  return prod.id == od[0];
                })[0];
                return {
                  wartosc: produkt.wartosc,
                  masa: produkt.masa,
                  objetosc: produkt.objetosc
                };
              };

              var stworzKrawedzie = function(wezly){

                var krawedzie = [];

                var krawedzieDlaEtapu = [];
                window._.each(wezly[1], function(w, index){
                  var masaWartoscObjetosc = dajMaseWartoscObjetosc(wezly[0][0].produkty, w.produkty);
                  krawedzieDlaEtapu.push({
                    z: [],
                    do: w.produkty,
                    wartosc: masaWartoscObjetosc.wartosc,
                    zmianaMasy: masaWartoscObjetosc.masa,
                    zmianaObjetosci: masaWartoscObjetosc.objetosc,
                    decyzja: 1
                  });
                  krawedzieDlaEtapu.push({
                    z: [],
                    do: w.produkty,
                    wartosc: 0,
                    zmianaMasy: 0,
                    zmianaObjetosci: 0,
                    decyzja: 0
                  });
                });

                krawedzie.push(krawedzieDlaEtapu);

                for(var i = 1; i<(wezly.length-1); i++){

                  var krawedzieDlaEtapu = [];

                  for(var j = 0; j<wezly[i].length; j++){

                    var wezlyPolaczone = window._.filter(wezly[i+1], function(wez){
                      return sprawdzCzyWezelJestPolaczony(wezly[i][j], wez);
                    });

                    window._.each(wezlyPolaczone, function(wezlyy, index){
                      var masaWartoscObjetosc = dajMaseWartoscObjetosc(wezly[i][j].produkty, wezlyy.produkty);
                      krawedzieDlaEtapu.push({
                        z: wezly[i][j].produkty,
                        do: wezlyy.produkty,
                        wartosc: masaWartoscObjetosc.wartosc,
                        zmianaMasy: masaWartoscObjetosc.masa,
                        zmianaObjetosci: masaWartoscObjetosc.objetosc,
                        decyzja: 1
                      });
                      krawedzieDlaEtapu.push({
                        z: wezly[i][j].produkty,
                        do: wezlyy.produkty,
                        wartosc: 0,
                        zmianaMasy: 0,
                        zmianaObjetosci: 0,
                        decyzja: 0
                      });
                    });

                  }

                  krawedzie.push(krawedzieDlaEtapu);

                }

                return krawedzie;
              };


              var sprawdzCzyWezelJestPolaczony = function(wez1, wez2){
                var result = true;
                window._.each(wez1.produkty, function(prod1, index){
                  var sprawdzCzyIstnieje = false;
                  window._.each(wez2.produkty, function(prod2, index){
                    if(prod1 == prod2){
                      sprawdzCzyIstnieje = true;
                    }
                  });
                  if(!sprawdzCzyIstnieje){
                    result = false;
                    return result;
                  }
                });
                return result;
              };

              var stworzWezly = function(liczbaProduktow){

                var wezly = [];

                var pierwszyEtap = [{
                  produkty: []
                }];
                wezly.push(pierwszyEtap);
                var drugiEtap = [];
                for(var i = 0; i<liczbaProduktow;i++){
                  drugiEtap.push({
                    produkty: [i]
                  });
                }

                wezly.push(drugiEtap);

                for(var i =1; i<liczbaProduktow; i++){
                  var etap = [];
                  for(var j = 0; j<wezly[i].length; j++){
                     for (var k = 0; k<liczbaProduktow; k++){
                      var klon = deepObjCopy(wezly[i][j]);
                      klon.produkty.push(k);
                      var nowy = {
                        produkty: klon.produkty
                      };
                      if(!sprawdzCzyWezelJestPoprawny(nowy) && sprawdzCzyJestUnikalny(etap, nowy)){
                        etap.push(nowy);
                      }
                     }
                  }
                  wezly.push(etap);
                }

                return wezly;
              };

              var sprawdzCzyWezelJestPoprawny = function(wezel){
                return (new Set(wezel.produkty)).size !== wezel.produkty.length;
              };

              var sprawdzCzyJestUnikalny = function(wezly, wezel){
                var result = true;
                window._.each(wezly, function(wez){
                  var ile = 0;
                  window._.each(wez.produkty, function(prod1){
                    window._.each(wezel.produkty, function(prod2){
                      if(prod1 == prod2){
                        ile++;
                      }
                    });
                  });
                  if(ile == wezel.produkty.length){
                      result = false;
                      return result;
                  }
                });
                return result;
              };

              function deepObjCopy (dupeObj) {
                var retObj = new Object();
                if (typeof(dupeObj) == 'object') {
                  if (typeof(dupeObj.length) != 'undefined')
                    var retObj = new Array();
                  for (var objInd in dupeObj) {
                    if (typeof(dupeObj[objInd]) == 'object') {
                      retObj[objInd] = deepObjCopy(dupeObj[objInd]);
                    } else if (typeof(dupeObj[objInd]) == 'string') {
                      retObj[objInd] = dupeObj[objInd];
                    } else if (typeof(dupeObj[objInd]) == 'number') {
                      retObj[objInd] = dupeObj[objInd];
                    } else if (typeof(dupeObj[objInd]) == 'boolean') {
                      ((dupeObj[objInd] == true) ? retObj[objInd] = true : retObj[objInd] = false);
                    }
                  }
                }
                return retObj;
              }

              $scope.dajSume = function(produkty, para){
                var result = 0;

                window._.each(produkty, function(prod){
                  result+=prod[para];
                });

                return result;
              };

            }]);
        </script>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: 'Arial';
            }

            .pointer {
              cursor: pointer;
            }

            .container {
              margin-top: 30px;
              margin-bottom: 30px;
            }

            h3 {
              display: inline-block;
            }

            .selectpicker {
              height: 34px;
            }

            table, th {
              text-align: center;
            }

            thead {
              background-color: #FCF8E0;
            }

            tfoot {
              background-color: #E0E0E0;
            }

            .dodaj {
              background-color: rgba(178, 221, 27, 0.14)
            }

            .usun {
              background-color: rgba(201, 106, 106, 0.51);
            }

        </style>
    </head>
    <body ng-app="app">
        <div class="container" ng-controller="MainController as c" ng-init="init()">
            <div class="row">
                <div class="col-xs-3">
                  <div class="form-group">
                        <label for="maskMasa">Maksymalna masa pojazdu</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="maskMasa" placeholder="30" ng-model="maksMasa">
                          <div class="input-group-addon">kg</div>
                        </div>
                  </div>
                </div>
                <div class="col-xs-3">
                  <div class="form-group">
                        <label for="maksObjetosc">Maksymalna objetosć pojazdu</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="maksObjetosc" placeholder="30" ng-model="maksObjetosc">
                        <div class="input-group-addon">l</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-xs-12"> 
                <a href="/addproduct"> dodaj produkt</a>
                      <h3>Wybierz produkty</h3>
                      <p>
                        Poniżej przedstawione sa wszystkie produkty, które sa akutalnie dostępne w bazie danych. Używajac przycisku <i class ="fa fa-plus-circle" aria-hidden="true"></i> proszę o wybór interesujacych Państwa przedmiotów.
                      </p>
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Akcja</th>
                            <th>Nazwa</th>
                            <th>Liczba sztuk</th>
                            <th>Objetosc [zł]</th>
                            <th>Masa [kg]</th>
                            <th>Wartosc [zł]</th>
                            <th>Miasto</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="produkt in wszystkieProdukty">
                            <td class="dodaj"><span class="pointer" ng-click="dodajProdukt(produkt)" ng-show="produkt.liczbaProduktow != 0"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></td>
                            <td>{[{produkt.nazwa}]}</td>
                            <td>{[{produkt.liczbaProduktow}]}</td>
                            <td>{[{produkt.objetosc}]}</td>
                            <td>{[{produkt.masa}]}</td>
                            <td>{[{produkt.wartosc}]}</td>
                            <td>{[{produkt.miasto}]}</td>
                          </tr>
                          </tbody>
                          <tfoot>
                          <tr>
                            <td>Razem</td>
                            <td>{[{}]}</td>
                            <td>{[{dajSume(wszystkieProdukty, 'liczbaProduktow')}]}</td>
                            <td>{[{dajSume(wszystkieProdukty, 'objetosc')}]}</td>
                            <td>{[{dajSume(wszystkieProdukty, 'masa')}]}</td>
                            <td>{[{dajSume(wszystkieProdukty, 'wartosc')}]}</td>
                            <td>{[{}]}</td>
                          </tr>
                          </tfoot>
                      </table>
                      <h3>Wybrana lista</h3>
                      <p>
                        Poniżej przedstawione sa produkty wybrane przez Państwa z pierwszej tabeli. Istnieje możliwosć usunięcia ich za pomoca przycisku <i class="fa fa-minus-circle" aria-hidden="true"></i>.
                      </p>
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Akcja</th>
                            <th>Nazwa</th>
                            <th>Liczba sztuk</th>
                            <th>Objetosc [zł]</th>
                            <th>Masa [kg]</th>
                            <th>Wartosc [zł]</th>
                            <th>Miasto</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="produkt in wybraneProdukty">
                            <td class="usun"><span class="pointer" ng-click="usunProdukt(produkt)"><i class="fa fa-minus-circle" aria-hidden="true"></i></span></td>
                            <td>{[{produkt.nazwa}]}</td>
                            <td>{[{produkt.liczbaProduktow}]}</td>
                            <td>{[{produkt.objetosc}]}</td>
                            <td>{[{produkt.masa}]}</td>
                            <td>{[{produkt.wartosc}]}</td>
                            <td>{[{produkt.miasto}]}</td>
                          </tr>
                          </tbody>
                          <tfoot>
                          <tr>
                            <td>Razem</td>
                            <td>{[{}]}</td>
                            <td>{[{dajSume(wybraneProdukty, 'liczbaProduktow')}]}</td>
                            <td>{[{dajSume(wybraneProdukty, 'objetosc')}]}</td>
                            <td>{[{dajSume(wybraneProdukty, 'masa')}]}</td>
                            <td>{[{dajSume(wybraneProdukty, 'wartosc')}]}</td>
                            <td>{[{}]}</td>
                          </tr>
                        </tfoot>
                      </table>

                      <button type="submit" ng-click="sprawdz()" class="btn btn-primary">Sprawdź, które przedmioty należy spakować</button> <br>
                      
                      <div ng-show="pierwszeSprawdzenie">

                      <br>
                      <br>
                      <h3>Produkty do wzięcia</h3>
                      <p>
                        Poniżej znajduje się propozycja przedmiotów, które należy zabrać, aby zysk był największy.
                      </p>
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Nazwa</th>
                            <th>Objetosc [zł]</th>
                            <th>Masa [kg]</th>
                            <th>Wartosc [zł]</th>
                            <th>Miasto</th>
                          </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="produkt in produktyDoWziecia track by $index">
                          <td>{[{produkt.nazwa}]}</td>
                          <td>{[{produkt.objetosc}]}</td>
                          <td>{[{produkt.masa}]}</td>
                          <td>{[{produkt.wartosc}]}</td>
                          <td>{[{produkt.miasto}]}</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                          <td>Razem</td>
                          <td>{[{dajSume(produktyDoWziecia, 'objetosc')}]}</td>
                          <td>{[{dajSume(produktyDoWziecia, 'masa')}]}</td>
                          <td>{[{dajSume(produktyDoWziecia, 'wartosc')}]}</td>
                          <td>{[{}]}</td>
                        </tr>
                        </tfoot>
                      </table>
            
                      <h3>Alternatywne propozycje</h3>

                      

                      </div>
                </div>
            </div>

            <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

           <!-- Modal content-->
          <div class="modal-content">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Dodaj produkt</h4>
                  </div>
                  <form>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="nazwa">Nazwa</label>
                        <input type="text" class="form-control" id="nazwa" placeholder="30" ng-required="true">
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="miasto">Miasto</label> <br>
                        <select class="selectpicker form-control" id="miasto" data-live-search="true" ng-required="true">
                            <option ng-repeat="city in cities" value="{[{city.id}]}">{[{city.miasto}]}</option>
                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="masa">Masa</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="masa" placeholder="30" ng-required="true">
                          <div class="input-group-addon">kg</div>
                        </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="objetosc">Objętosć</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="objetosc" placeholder="30" ng-required="true">
                          <div class="input-group-addon">l</div>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="wartosc">Wartosć</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="wartosc" placeholder="30" ng-required="true">
                          <div class="input-group-addon">zł</div>
                        </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                        <label for="lsztuk">Liczba sztuk</label>
                        <div class="input-group">
                          <input type="number" class="form-control" id="lsztuk" placeholder="30" ng-required="true">
                          <div class="input-group-addon">sztuk</div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Dodaj</button>
                </div>
                </form>
          </div>

          </div>
        </div>


        </div>
    </body>
</html>
