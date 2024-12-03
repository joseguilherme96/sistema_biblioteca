<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\LivroModel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('livro', function (Blueprint $table) {
            //
        });

        $livroModel = new LivroModel();

        $livroModel->insert([
            [
                'nome' => 'O homem mais rico da Babilônia',
                'descricao' => 'Baseando-se nos segredos de sucesso dos antigos babilônicos ― os habitantes da cidade mais rica e próspera de seu tempo ―, George S. Clason mostra soluções ao mesmo tempo sábias e muito atuais para evitar a falta de dinheiro, como não desperdiçar recursos durante tempos de opulência, buscar conhecimento e informação em vez de apenas lucro, assegurar uma renda para o futuro, manter a pontualidade no pagamento de dívidas e, sobretudo, cultivar as próprias aptidões, tornando-se cada vez mais habilidoso e consciente.',
                'Autor' => 'George S. Clason',
                'Categoria' => 'Economia',
                'nme_img_cap_lvro' => 'cpa_lvro_o_home_mais_rico_da_babilônia_1727178990.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Harry Potter e a Câmara Secreta',
                'descricao' => 'Depois de férias aborrecidas na casa dos tios trouxas, está na hora de Harry Potter voltar a estudar. Coisas acontecem, no entanto, para dificultar o regresso de Harry. Persistente e astuto, o herói não se deixa intimidar pelos obstáculos e, com a ajuda dos fiéis amigos Weasley, começa o ano letivo na Escola de Magia e Bruxaria de Hogwarts. As novidades não são poucas. Novos colegas, novos professores, muitas e boas descobertas e um grande e perigosos desafio. Alguém ou alguma coisa ameaça a segurança e a tranquilidade dos membros de Hogwarts.',
                'Autor' => 'J.K. Rowling',
                'Categoria' => 'Fantasia',
                'nme_img_cap_lvro' => 'cpa_lvro_harry_potter_e_a_câmara_secret_1727194238.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Jogador Numero 1',
                'descricao' => 'Um mundo em jogo, a busca pelo grande prêmio. Você está preparado, Jogador número 1? O ano é 2044 e a Terra não é mais a mesma. Fome, guerras e desemprego empurraram a humanidade para um estado de apatia nunca antes visto.Wade Watts é mais um dos que escapa da desanimadora realidade passando horas e horas conectado ao OASIS ? uma utopia virtual global que permite aos usuários ser o que quiserem, um lugar onde se pode viver e se apaixonar em qualquer um dos mundos inspirados nos filmes, videogames e cultura pop dos anos 1980.Mas a possibilidade de existir em outra realidade não é o único atrativo do OASIS, o falecido James Halliday, bilionário e criador do jogo, escondeu em algum lugar desse imenso playground uma série de easter-eggs que premiará com sua enorme fortuna ? e poder ? aquele que conseguir desvendá-los. E Wade acabou de encontrar o primeiro deles.Um novo Matrix.? USA Today ?O fenômeno do ano.? New York Times ?Cline é capaz de incorporar seus brinquedos e jogos favoritos em uma narrativa perfeita.? The New York Times ?',
                'Autor' => 'Ernest Cline',
                'Categoria' => 'Ficção',
                'nme_img_cap_lvro' => 'cpa_lvro_jogador_número_1_1727194123.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'Estilhaça-me',
                'descricao' => 'Um toque é o bastante.Com apenas um toque, Juliette Ferrars é capaz de fazer um homem adulto se ajoelhar de dor e implorar por misericórdia. Um único toque de Juliette pode matar.Ninguém sabe por que a garota tem um poder tão impressionante, o qual ela acredita ser uma maldição, um fardo que uma pessoa sozinha seria incapaz de carregar. Contudo, o Restabelecimento enxerga essa característica como um dom e passa a vê-la como uma oportunidade uma oportunidade de usá-la como arma letal. Porém, Juliette tem seus próprios planos.',
                'Autor' => ' Tahereh Mafi',
                'Categoria' => 'Romance',
                'nme_img_cap_lvro' => 'cpa_lvro_estilhaça-me_1727186285.jpg',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'nome' => 'A Rainha Vermelha',
                'descricao' => 'A Rainha Vermelha é um romance de fantasia escrita por Victoria Aveyard. Publicada originalmente em 2011, A Rainha Vermelha é a primeira parte de uma trilogia de romance de fantasia escrita por Victoria Aveyard. A Rainha Vermelha é a primeira parte de uma trilogia de romance de fantasia escrita por Victoria Aveyard. A Rainha Vermelha é a primeira parte de uma trilogia de romance de fantasia escrita por Victoria Aveyard.',
                'Autor' => 'Victoria Aveyard',
                'Categoria' => 'Fantasia',
                'nme_img_cap_lvro' => 'cpa_lvro_a_rainha_vermelha_1727186139.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nome' => 'A Arte de Ligar o Foda-se',
                'descricao' => 'Chega de tentar buscar um sucesso que só existe na sua cabeça. Chega de se torturar para pensar positivo enquanto sua vida vai ladeira abaixo. Chega de se sentir inferior por não ver o lado bom de estar no fundo do poço.
                Coaching, autoajuda, desenvolvimento pessoal, mentalização positiva - sem querer desprezar o valor de nada disso, a grande verdade é que às vezes nos sentimos quase sufocados diante da pressão infinita por parecermos otimistas o tempo todo. É um pecado social se deixar abater quando as coisas não vão bem. Ninguém pode fracassar simplesmente, sem aprender nada com isso. Não dá mais. É insuportável. E é aí que entra a revolucionária e sutil arte de ligar o foda-se.',
                'autor' => ' Mark Manson',
                'Categoria' => 'Autoajuda',
                'nme_img_cap_lvro' => 'cpa_livro_a_arte_de_ligar_o_fada_se_1727186139.jpg',
                'created_at' => now(),
                'updated_at' => now()

            ],
            [
                'nome' => 'Acupuntura Clássica Chinesa',
                'descricao' => 'A acupuntura é o conjunto de conhecimentos da medicina chinesa tradicional que visa o restabelecimento da saúde por meio da aplicação de agulhas e de moxas, além do uso de outras técnicas.
                Surgida na China há aproximadamente 4.500 anos, a acupuntura continua sendo um campo aberto à pesquisa e a novos conhecimentos, embora as descobertas mais recentes demonstrem que suas antigas fórmulas e princípios ainda não foram superados. Desse modo, aqueles que a praticam devem compenetrar-se da sua importância e estudar e assimilar perfeitamente seus ensinamentos. Nessa obra de extrema importância na bibliografia sobre o assunto, o dr. Tom Sintan Wen - médico formado nas medicinas ocidental e oriental, dedicado à pesquisa e à prática nos campos da neurocirurgia, fisiatria e acupuntura, e com experiência acumulada nesses dois tipos de medicina, - disponibiliza as milenares técnicas dessa arte de cura, bem como a aplicação as vantagens do seu uso, tendo sempre em vista as atuais conquistas da medicina tradicional. Um manual que preencherá uma importante lacuna na bibliografia sobre o tema publicada no Brasil.',
                'autor' => 'Tom Sintan Wen',
                'Categoria' => 'Acupuntura',
                'nme_img_cap_lvro' => 'cpa_lvro_acunputura_1727741605.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livro', function (Blueprint $table) {
            Schema::dropIfExists('livro');
        });
    }
};
