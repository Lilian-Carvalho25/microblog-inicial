# Sobre as áreas do site

## PÚBLICA
Páginas que **não precisam de autenticação** para acesso.
São as páginas na raíz do projeto: 
- index;
- noticia; 
- login;
- resultado.

# ADMINISTRATIVA
Páginas que **precisam de autenticação** para o acesso, sendo que algumas delas tem privilégios
de acesso diferenciados.

São as pastas contidas na pasta **admin** do projeto: 
- index;
- usuarios;
- usuario-insere;
- usuario-atualiza;
- usuario-exclui;
- noticias;
- noticia-insere;
- noticia-atualiza;
- noticia-exclui;
- nao-autorizado.

### Privilégios de acesso
Usuários do tipo **admin**, podem acesssar/modificar **TUDO**.
Usuários do tipo **editor**, podem acessar/modificar **somente** seus próprios dados e suas próprias notícias.
