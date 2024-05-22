# Respostas:


## A) **Consultas Básicas:**

### - Lista de funcionários ordenando pelo salário decrescente.

````SQL
    SELECT nome, salario FROM VENDEDORES
    WHERE inativo = 0
    ORDER BY salario DESC; 
````

### - Lista de pedidos de vendas ordenado por data de emissão.

````SQL
    SELECT * FROM PEDIDO
    WHERE situacao = 'EMITIDO'  -- ou outro status desejado
    ORDER BY data_emissao DESC;
````

*Essa consulta seleciona todos os pedidos de vendas com status "EMITIDO" (ou outro status desejado) e os ordena pela data de emissão em ordem decrescente.*

### - Valor de faturamento por cliente.

````SQL
    SELECT c.razao_social, SUM(p.valor_total) AS faturamento_total
    FROM CLIENTES c
    JOIN PEDIDO p ON c.id_cliente = p.id_cliente
    WHERE c.inativo = 0 AND p.situacao = 'EMITIDO'  -- ou outro status desejado
    GROUP BY c.razao_social
    ORDER BY faturamento_total DESC;
````

*Essa consulta junta as tabelas CLIENTES e PEDIDO, seleciona os clientes ativos e os pedidos de vendas com status "EMITIDO" (ou outro status desejado), soma o valor total de cada pedido por cliente e ordena os resultados pelo faturamento total em ordem decrescente.*

### - Valor de faturamento por empresa.

````SQL
    SELECT e.razao_social, SUM(p.valor_total) AS faturamento_total
    FROM EMPRESA e
    JOIN PEDIDO p ON e.id_empresa = p.id_empresa
    WHERE e.inativo = 0 AND p.situacao = 'EMITIDO'  -- ou outro status desejado
    GROUP BY e.razao_social
    ORDER BY faturamento_total DESC;
````
*Essa consulta junta as tabelas EMPRESA e PEDIDO, seleciona as empresas ativas e os pedidos de vendas com status "EMITIDO" (ou outro status desejado), soma o valor total de cada pedido por empresa e ordena os resultados pelo faturamento total em ordem decrescente.*

### - Valor de faturamento por vendedor.

````SQL
    SELECT v.nome, SUM(p.valor_total) AS faturamento_total
    FROM VENDEDORES v
    JOIN CLIENTES c ON v.id_vendedor = c.id_vendedor
    JOIN PEDIDO p ON c.id_cliente = p.id_cliente
    WHERE v.inativo = 0 AND c.inativo = 0 AND p.situacao = 'EMITIDO'  -- ou outro status desejado
    GROUP BY v.nome
    ORDER BY faturamento_total DESC;
````

*Essa consulta junta as tabelas VENDEDORES, CLIENTES e PEDIDO, seleciona os vendedores ativos, os clientes ativos e os pedidos de vendas com status "EMITIDO" (ou outro status desejado), soma o valor total de cada pedido por vendedor e ordena os resultados pelo faturamento total em ordem decrescente.*

# Respostas:


## B) **Consultas de Junção:**

````SQL
    SELECT 
    p.id_produto,
    p.descricao,
    c.id_cliente,
    c.razao_social AS cliente_razao_social,
    e.id_empresa,
    e.razao_social AS empresa_razao_social,
    v.id_vendedor,
    v.nome AS vendedor_nome,
    cpp.preco_minimo,
    cpp.preco_maximo,
    COALESCE(ip.preco_praticado, cpp.preco_minimo) AS preco_base
    FROM PRODUTOS p
    JOIN (
    SELECT ip.id_produto, ip.id_cliente, ip.preco_praticado, ROW_NUMBER() OVER (PARTITION BY ip.id_produto, ip.id_cliente ORDER BY ip.data_emissao DESC) AS row_num
    FROM ITENS_PEDIDO ip
    JOIN PEDIDO p ON ip.id_pedido = p.id_pedido
    ) ip ON p.id_produto = ip.id_produto AND ip.row_num = 1
    JOIN CLIENTES c ON p.id_produto = c.id_produto
    JOIN EMPRESA e ON c.id_empresa = e.id_empresa
    JOIN VENDEDORES v ON c.id_vendedor = v.id_vendedor
    JOIN CONFIG_PRECO_PRODUTO cpp ON p.id_produto = cpp.id_produto AND c.id_empresa = cpp.id_empresa
    ORDER BY p.id_produto, c.id_cliente;
````

**Explicação:**

- *Primeiramente, criamos uma subconsulta que seleciona o último preço praticado para cada produto e cliente, utilizando a função ROW_NUMBER() para numerar as linhas por produto e cliente, ordenadas pela data de emissão em ordem decrescente.*

- *Em seguida, realizamos as junções necessárias entre as tabelas PRODUTOS, CLIENTES, EMPRESA, VENDEDORES e CONFIG_PRECO_PRODUTO.*

- *Utilizamos a função COALESCE para definir o preço base do produto. Se o último preço praticado for encontrado, utilizamos esse valor. Caso contrário, utilizamos o preço mínimo da configuração de preço.*

- *Por fim, ordenamos os resultados pela chave composta id_produto e id_cliente.*
