<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CountryController extends ApiController
{

    /**
     * @description Get all countries
     * @param Request $request
     * @return JsonResponse
     */
    public function getCountry(Request $request): JsonResponse
    {
        $countries = [
            ["code" => "AFG", "name" => "Afghanistan", "nationality" => "Afghane"],
            ["code" => "ALB", "name" => "Albanie", "nationality" => "Albanaise"],
            ["code" => "DZA", "name" => "Algérie", "nationality" => "Algérienne"],
            ["code" => "DEU", "name" => "Allemagne", "nationality" => "Allemande"],
            ["code" => "USA", "name" => "Etats-Unis", "nationality" => "Américaine"],
            ["code" => "AND", "name" => "Andorre", "nationality" => "Andorrane"],
            ["code" => "AGO", "name" => "Angola", "nationality" => "Angolaise"],
            ["code" => "ATG", "name" => "Antigua-et-Barbuda", "nationality" => "Antiguaise-et-Barbudienne"],
            ["code" => "ARG", "name" => "Argentine", "nationality" => "Argentine"],
            ["code" => "ARM", "name" => "Arménie", "nationality" => "Arménienne"],
            ["code" => "AUS", "name" => "Australie", "nationality" => "Australienne"],
            ["code" => "AUT", "name" => "Autriche", "nationality" => "Autrichienne"],
            ["code" => "AZE", "name" => "Azerbaïdjan", "nationality" => "Azerbaïdjanaise"],
            ["code" => "BHS", "name" => "Bahamas", "nationality" => "Bahamienne"],
            ["code" => "BHR", "name" => "Bahreïn", "nationality" => "Bahreinienne"],
            ["code" => "BGD", "name" => "Bangladesh", "nationality" => "Bangladaise"],
            ["code" => "BRB", "name" => "Barbade", "nationality" => "Barbadienne"],
            ["code" => "BEL", "name" => "Belgique", "nationality" => "Belge"],
            ["code" => "BLZ", "name" => "Belize", "nationality" => "Belizienne"],
            ["code" => "BEN", "name" => "Bénin", "nationality" => "Béninoise"],
            ["code" => "BTN", "name" => "Bhoutan", "nationality" => "Bhoutanaise"],
            ["code" => "BLR", "name" => "Biélorussie", "nationality" => "Biélorusse"],
            ["code" => "MMR", "name" => "Birmanie", "nationality" => "Birmane"],
            ["code" => "GNB", "name" => "Guinée-Bissau", "nationality" => "Bissau-Guinéenne"],
            ["code" => "BOL", "name" => "Bolivie", "nationality" => "Bolivienne"],
            ["code" => "BIH", "name" => "Bosnie-Herzégovine", "nationality" => "Bosnienne"],
            ["code" => "BWA", "name" => "Botswana", "nationality" => "Botswanaise"],
            ["code" => "BRA", "name" => "Brésil", "nationality" => "Brésilienne"],
            ["code" => "GBR", "name" => "Royaume-Uni", "nationality" => "Britannique"],
            ["code" => "BRN", "name" => "Brunéi", "nationality" => "Brunéienne"],
            ["code" => "BGR", "name" => "Bulgarie", "nationality" => "Bulgare"],
            ["code" => "BFA", "name" => "Burkina", "nationality" => "Burkinabé"],
            ["code" => "BDI", "name" => "Burundi", "nationality" => "Burundaise"],
            ["code" => "KHM", "name" => "Cambodge", "nationality" => "Cambodgienne"],
            ["code" => "CMR", "name" => "Cameroun", "nationality" => "Camerounaise"],
            ["code" => "CAN", "name" => "Canada", "nationality" => "Canadienne"],
            ["code" => "CPV", "name" => "Cap-Vert", "nationality" => "Cap-verdienne"],
            ["code" => "CAF", "name" => "Centrafrique", "nationality" => "Centrafricaine"],
            ["code" => "CHL", "name" => "Chili", "nationality" => "Chilienne"],
            ["code" => "CHN", "name" => "Chine", "nationality" => "Chinoise"],
            ["code" => "CYP", "name" => "Chypre", "nationality" => "Chypriote"],
            ["code" => "COL", "name" => "Colombie", "nationality" => "Colombienne"],
            ["code" => "COM", "name" => "Comores", "nationality" => "Comorienne"],
            ["code" => "COD", "name" => "Congo-Kinshasa", "nationality" => "Congolaise"],
            ["code" => "COG", "name" => "Congo-Brazzaville", "nationality" => "Congolaise"],
            ["code" => "COK", "name" => "Iles Cook", "nationality" => "Cookienne"],
            ["code" => "CRI", "name" => "Costa Rica", "nationality" => "Costaricaine"],
            ["code" => "HRV", "name" => "Croatie", "nationality" => "Croate"],
            ["code" => "CUB", "name" => "Cuba", "nationality" => "Cubaine"],
            ["code" => "DNK", "name" => "Danemark", "nationality" => "Danoise"],
            ["code" => "DJI", "name" => "Djibouti", "nationality" => "Djiboutienne"],
            ["code" => "DOM", "name" => "République dominicaine", "nationality" => "Dominicaine"],
            ["code" => "DMA", "name" => "Dominique", "nationality" => "Dominiquaise"],
            ["code" => "EGY", "name" => "Egypte", "nationality" => "Egyptienne"],
            ["code" => "ARE", "name" => "Emirats arabes unis", "nationality" => "Emirienne"],
            ["code" => "GNQ", "name" => "Guinée équatoriale", "nationality" => "Equato-guineenne"],
            ["code" => "ECU", "name" => "Equateur", "nationality" => "Equatorienne"],
            ["code" => "ERI", "name" => "Erythrée", "nationality" => "Erythréenne"],
            ["code" => "ESP", "name" => "Espagne", "nationality" => "Espagnole"],
            ["code" => "TLS", "name" => "Timor-Leste", "nationality" => "Est-timoraise"],
            ["code" => "EST", "name" => "Estonie", "nationality" => "Estonienne"],
            ["code" => "ETH", "name" => "Ethiopie", "nationality" => "Ethiopienne"],
            ["code" => "FJI", "name" => "Fidji", "nationality" => "Fidjienne"],
            ["code" => "FIN", "name" => "Finlande", "nationality" => "Finlandaise"],
            ["code" => "FRA", "name" => "France", "nationality" => "Française"],
            ["code" => "GAB", "name" => "Gabon", "nationality" => "Gabonaise"],
            ["code" => "GMB", "name" => "Gambie", "nationality" => "Gambienne"],
            ["code" => "GEO", "name" => "Géorgie", "nationality" => "Georgienne"],
            ["code" => "GHA", "name" => "Ghana", "nationality" => "Ghanéenne"],
            ["code" => "GRD", "name" => "Grenade", "nationality" => "Grenadienne"],
            ["code" => "GTM", "name" => "Guatemala", "nationality" => "Guatémaltèque"],
            ["code" => "GIN", "name" => "Guinée", "nationality" => "Guinéenne"],
            ["code" => "GUY", "name" => "Guyana", "nationality" => "Guyanienne"],
            ["code" => "HTI", "name" => "Haïti", "nationality" => "Haïtienne"],
            ["code" => "GRC", "name" => "Grèce", "nationality" => "Hellénique"],
            ["code" => "HND", "name" => "Honduras", "nationality" => "Hondurienne"],
            ["code" => "HUN", "name" => "Hongrie", "nationality" => "Hongroise"],
            ["code" => "IND", "name" => "Inde", "nationality" => "Indienne"],
            ["code" => "IDN", "name" => "Indonésie", "nationality" => "Indonésienne"],
            ["code" => "IRQ", "name" => "Iraq", "nationality" => "Irakienne"],
            ["code" => "IRN", "name" => "Iran", "nationality" => "Iranienne"],
            ["code" => "IRL", "name" => "Irlande", "nationality" => "Irlandaise"],
            ["code" => "ISL", "name" => "Islande", "nationality" => "Islandaise"],
            ["code" => "ISR", "name" => "Israël", "nationality" => "Israélienne"],
            ["code" => "ITA", "name" => "Italie", "nationality" => "Italienne"],
            ["code" => "CIV", "name" => "Côte d'Ivoire", "nationality" => "Ivoirienne"],
            ["code" => "JAM", "name" => "Jamaïque", "nationality" => "Jamaïcaine"],
            ["code" => "JPN", "name" => "Japon", "nationality" => "Japonaise"],
            ["code" => "JOR", "name" => "Jordanie", "nationality" => "Jordanienne"],
            ["code" => "KAZ", "name" => "Kazakhstan", "nationality" => "Kazakhstanaise"],
            ["code" => "KEN", "name" => "Kenya", "nationality" => "Kenyane"],
            ["code" => "KGZ", "name" => "Kirghizistan", "nationality" => "Kirghize"],
            ["code" => "KIR", "name" => "Kiribati", "nationality" => "Kiribatienne"],
            ["code" => "KNA", "name" => "Saint-Christophe-et-Niévès", "nationality" => "Kittitienne et Névicienne"],
            ["code" => "KWT", "name" => "Koweït", "nationality" => "Koweïtienne"],
            ["code" => "LAO", "name" => "Laos", "nationality" => "Laotienne"],
            ["code" => "LSO", "name" => "Lesotho", "nationality" => "Lesothane"],
            ["code" => "LVA", "name" => "Lettonie", "nationality" => "Lettone"],
            ["code" => "LBN", "name" => "Liban", "nationality" => "Libanaise"],
            ["code" => "LBR", "name" => "Libéria", "nationality" => "Libérienne"],
            ["code" => "LBY", "name" => "Libye", "nationality" => "Libyenne"],
            ["code" => "LIE", "name" => "Liechtenstein", "nationality" => "Liechtensteinoise"],
            ["code" => "LTU", "name" => "Lituanie", "nationality" => "Lituanienne"],
            ["code" => "LUX", "name" => "Luxembourg", "nationality" => "Luxembourgeoise"],
            ["code" => "MKD", "name" => "Macédoine", "nationality" => "Macédonienne"],
            ["code" => "MYS", "name" => "Malaisie", "nationality" => "Malaisienne"],
            ["code" => "MWI", "name" => "Malawi", "nationality" => "Malawienne"],
            ["code" => "MDV", "name" => "Maldives", "nationality" => "Maldivienne"],
            ["code" => "MDG", "name" => "Madagascar", "nationality" => "Malgache"],
            ["code" => "MLI", "name" => "Mali", "nationality" => "Malienne"],
            ["code" => "MLT", "name" => "Malte", "nationality" => "Maltaise"],
            ["code" => "MAR", "name" => "Maroc", "nationality" => "Marocaine"],
            ["code" => "MHL", "name" => "Iles Marshall", "nationality" => "Marshallaise"],
            ["code" => "MUS", "name" => "Maurice", "nationality" => "Mauricienne"],
            ["code" => "MRT", "name" => "Mauritanie", "nationality" => "Mauritanienne"],
            ["code" => "MEX", "name" => "Mexique", "nationality" => "Mexicaine"],
            ["code" => "FSM", "name" => "Micronésie", "nationality" => "Micronésienne"],
            ["code" => "MDA", "name" => "Moldovie", "nationality" => "Moldave"],
            ["code" => "MCO", "name" => "Monaco", "nationality" => "Monegasque"],
            ["code" => "MNG", "name" => "Mongolie", "nationality" => "Mongole"],
            ["code" => "MNE", "name" => "Monténégro", "nationality" => "Monténégrine"],
            ["code" => "MOZ", "name" => "Mozambique", "nationality" => "Mozambicaine"],
            ["code" => "NAM", "name" => "Namibie", "nationality" => "Namibienne"],
            ["code" => "NRU", "name" => "Nauru", "nationality" => "Nauruane"],
            ["code" => "NLD", "name" => "Pays-Bas", "nationality" => "Néerlandaise"],
            ["code" => "NZL", "name" => "Nouvelle-Zélande", "nationality" => "Néo-Zélandaise"],
            ["code" => "NPL", "name" => "Népal", "nationality" => "Népalaise"],
            ["code" => "NIC", "name" => "Nicaragua", "nationality" => "Nicaraguayenne"],
            ["code" => "NGA", "name" => "Nigéria", "nationality" => "Nigériane"],
            ["code" => "NER", "name" => "Niger", "nationality" => "Nigérienne"],
            ["code" => "NIU", "name" => "Niue", "nationality" => "Niuéenne"],
            ["code" => "PRK", "name" => "Corée du Nord", "nationality" => "Nord-coréenne"],
            ["code" => "NOR", "name" => "Norvège", "nationality" => "Norvégienne"],
            ["code" => "OMN", "name" => "Oman", "nationality" => "Omanaise"],
            ["code" => "UGA", "name" => "Ouganda", "nationality" => "Ougandaise"],
            ["code" => "UZB", "name" => "Ouzbékistan", "nationality" => "Ouzbéke"],
            ["code" => "PAK", "name" => "Pakistan", "nationality" => "Pakistanaise"],
            ["code" => "PLW", "name" => "Palaos", "nationality" => "Palaosienne"],
            ["code" => "PSE", "name" => "Palestine", "nationality" => "Palestinienne"],
            ["code" => "PAN", "name" => "Panama", "nationality" => "Panaméenne"],
            ["code" => "PNG", "name" => "Papouasie-Nouvelle-Guinée", "nationality" => "Papouane-Néo-Guinéenne"],
            ["code" => "PRY", "name" => "Paraguay", "nationality" => "Paraguayenne"],
            ["code" => "PER", "name" => "Pérou", "nationality" => "Péruvienne"],
            ["code" => "PHL", "name" => "Philippines", "nationality" => "Philippine"],
            ["code" => "POL", "name" => "Pologne", "nationality" => "Polonaise"],
            ["code" => "PRT", "name" => "Portugal", "nationality" => "Portugaise"],
            ["code" => "QAT", "name" => "Qatar", "nationality" => "Qatarienne"],
            ["code" => "ROU", "name" => "Roumanie", "nationality" => "Roumaine"],
            ["code" => "RUS", "name" => "Russie", "nationality" => "Russe"],
            ["code" => "RWA", "name" => "Rwanda", "nationality" => "Rwandaise"],
            ["code" => "LCA", "name" => "Sainte-Lucie", "nationality" => "Saint-Lucienne"],
            ["code" => "SMR", "name" => "Saint-Marin", "nationality" => "Saint-Marinaise"],
            ["code" => "VCT", "name" => "Saint-Vincent-et-les Grenadines", "nationality" => "Saint-Vincentaise et Grenadine"],
            ["code" => "SLB", "name" => "Iles Salomon", "nationality" => "Salomonaise"],
            ["code" => "SLV", "name" => "Salvador", "nationality" => "Salvadorienne"],
            ["code" => "WSM", "name" => "Samoa", "nationality" => "Samoane"],
            ["code" => "STP", "name" => "Sao Tomé-et-Principe", "nationality" => "Santoméenne"],
            ["code" => "SAU", "name" => "Arabie saoudite", "nationality" => "Saoudienne"],
            ["code" => "SEN", "name" => "Sénégal", "nationality" => "Sénégalaise"],
            ["code" => "SRB", "name" => "Serbie", "nationality" => "Serbe"],
            ["code" => "SYC", "name" => "Seychelles", "nationality" => "Seychelloise"],
            ["code" => "SLE", "name" => "Sierra Leone", "nationality" => "Sierra-Léonaise"],
            ["code" => "SGP", "name" => "Singapour", "nationality" => "Singapourienne"],
            ["code" => "SVK", "name" => "Slovaquie", "nationality" => "Slovaque"],
            ["code" => "SVN", "name" => "Slovénie", "nationality" => "Slovène"],
            ["code" => "SOM", "name" => "Somalie", "nationality" => "Somalienne"],
            ["code" => "SDN", "name" => "Soudan", "nationality" => "Soudanaise"],
            ["code" => "LKA", "name" => "Sri Lanka", "nationality" => "Sri-Lankaise"],
            ["code" => "ZAF", "name" => "Afrique du Sud", "nationality" => "Sud-Africaine"],
            ["code" => "KOR", "name" => "Corée du Sud", "nationality" => "Sud-Coréenne"],
            ["code" => "SSD", "name" => "Soudan du Sud", "nationality" => "Sud-Soudanaise"],
            ["code" => "SWE", "name" => "Suède", "nationality" => "Suédoise"],
            ["code" => "CHE", "name" => "Suisse", "nationality" => "Suisse"],
            ["code" => "SUR", "name" => "Suriname", "nationality" => "Surinamaise"],
            ["code" => "SWZ", "name" => "Swaziland", "nationality" => "Swazie"],
            ["code" => "SYR", "name" => "Syrie", "nationality" => "Syrienne"],
            ["code" => "TJK", "name" => "Tadjikistan", "nationality" => "Tadjike"],
            ["code" => "TZA", "name" => "Tanzanie", "nationality" => "Tanzanienne"],
            ["code" => "TCD", "name" => "Tchad", "nationality" => "Tchadienne"],
            ["code" => "CZE", "name" => "Tchéquie", "nationality" => "Tchèque"],
            ["code" => "THA", "name" => "Thaïlande", "nationality" => "Thaïlandaise"],
            ["code" => "TGO", "name" => "Togo", "nationality" => "Togolaise"],
            ["code" => "TON", "name" => "Tonga", "nationality" => "Tonguienne"],
            ["code" => "TTO", "name" => "Trinité-et-Tobago", "nationality" => "Trinidadienne"],
            ["code" => "TUN", "name" => "Tunisie", "nationality" => "Tunisienne"],
            ["code" => "TKM", "name" => "Turkménistan", "nationality" => "Turkmène"],
            ["code" => "TUR", "name" => "Turquie", "nationality" => "Turque"],
            ["code" => "TUV", "name" => "Tuvalu", "nationality" => "Tuvaluane"],
            ["code" => "UKR", "name" => "Ukraine", "nationality" => "Ukrainienne"],
            ["code" => "URY", "name" => "Uruguay", "nationality" => "Uruguayenne"],
            ["code" => "VUT", "name" => "Vanuatu", "nationality" => "Vanuatuane"],
            ["code" => "VAT", "name" => "Vatican", "nationality" => "Vaticane"],
            ["code" => "VEN", "name" => "Venezuela", "nationality" => "Vénézuélienne"],
            ["code" => "VNM", "name" => "Viêt Nam", "nationality" => "Vietnamienne"],
            ["code" => "YEM", "name" => "Yémen", "nationality" => "Yéménite"],
            ["code" => "ZMB", "name" => "Zambie", "nationality" => "Zambienne"],
            ["code" => "ZWE", "name" => "Zimbabwe", "nationality" => "Zimbabwéenne"],
        ];
        return $this->jsonResponse($countries, ResponseAlias::HTTP_OK);
    }
}