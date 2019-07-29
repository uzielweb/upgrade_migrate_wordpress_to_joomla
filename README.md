# upgrade_migrate_wordpress_to_joomla

Conhecimentos básicos necessários:
- instalar extensões
- usar o editor de sql do phpmyadmin
- editar arquivo php para incluir dados de conexão
- saber fazer backup e importação de banco de dados (arquivos sql)

Extensões e scripts necessários e úteis:

- CMigrator
- J2XML
- Allvideos Plugin
- DBReplacer da RegularLabs
- E mais uns scripts que fiz: https://github.com/.../upgrade_migrate_wordpress_to_joomla

As pastas de wp-content/uploads devem ser copiadas para a pasta images e a pasta cmigration também.


Abaixo segue um exemplo hardcore :) onde você pode sair de uma versão do Joomla 1.5 e fazer upgrade importando dados do wordpress (ou não) até a versão 3



    Configure o servidor para rodar php 5.2
    Exemplo de configuração do htaccess:
    # php -- BEGIN cPanel-generated handler, do not edit
    # Defina o pacote “alt-php51” como a linguagem padrão de programação “PHP”.
    <IfModule mime_module>
    AddHandler application/x-httpd-alt-php52___lsphp .php .php5 .phtml
    </IfModule>
    # php -- END cPanel-generated handler, do not edit
    Instale Joomla 1.5
    Instale o Jupgrade
    Habilite o Plugin MooTools Upgrade
    Para prevenir erro na atualização vá via ftp em
    jupgrade/installation/models/configuration.php
    e jupgrade/installation/models/database.php
    e insira a seguinte linha na parte superior do script:
    require_once JPATH_ROOT.'/jupgrade/libraries/cms/model/legacy.php';
    Faça Upgrade do Joomla 1.5 para 2.5
    Configure o servidor para rodar php 5.3
    Instale o CMigrator
    Copie o Banco de dados Wordpress para o mesmo Banco do Joomla 2.5
    Vá nas configurações do CMigrator e crie uma nova configuração, colocando em Parsing configuration >> Base site URL o endereço do site antigo (base url do wordpress), do qual o conteúdo será importado
    Migre usando o C-MIgrator clicando em Migrate
    Depois clique em Parsing Migration. Isso removerá todo conteúdo antigo incompatível e, de quebra trará todas as URLs do Wordpress (absolutas) para as do Joomla (relativas).
    Isso pode levar realmente bastante tempo a depender do tamanho do conteúdo.
    Use o Script de Migração de destaques do Wordpress e copie para o banco de dados do Joomla
    Atualize o Joomla para versões superiores
