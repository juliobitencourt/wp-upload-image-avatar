# Função WordPress Uplooad Avatar

[![PHP from Packagist](https://img.shields.io/packagist/php-v/symfony/symfony.svg)]()
[![Packagist](https://img.shields.io/packagist/dm/doctrine/orm.svg)]()

Esta função permite você fazer o upload de uma imagem e adicionar como avatar do usuário.

### Como utilizar? ###

Para a função relacionar a imagem que está fazendo upload como Avatar de um usuário especifico, você deve ter instalado o plugin [WP User Avatar](https://br.wordpress.org/plugins/wp-user-avatar/).

É possível fazer upload do arquivo na pasta raiz do projeto e acessa-lo(http://seusite.com/upload_avatar.php) pelo navegador e passar dois parâmetro na URL.
- **1˚ - URL da imagem(image_url=https://imagemdoavatar.jpg)**
- **2˚ - ID do Usuário que deseja inserir o Avatar(user_id=Numero)**

_Caminho completo: http://seusite.com/upload_avatar.php?image_url=https://imagemdoavatar.jpg&user_id=Numero

### Como contribuir? ###
Como não sou o melhor Dev PHP do mundo, adorária que você revisasse o código e melhorasse caso tenha feito algo errado.

Fiquem à vontade para contribuir!