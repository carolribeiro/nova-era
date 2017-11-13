<aside class="menu-painel">
	<i class="fa fa-bars" data-dropdown="link"></i>
	<ul class="ul-menu" data-dropdown="content">
		<li class="li">
			<a href="/admin" class="link link-dash">Início</a>
		</li>
		<li class="li">
			<a class="link" data-dropdown="link">Notícias</a>
			<ul class="submenu" data-dropdown="content">
				<li class="li">
					<a href="/admin/modulos/noticias/dados.php" class="link">Cadastrar</a>
				</li>
				<li class="li">
					<a href="/admin/modulos/noticias/gerenciar.php" class="link">Gerenciar</a>
				</li>
			</ul>
		</li>
		<li class="li">
			<a class="link" data-dropdown="link">Documentos</a>
			<ul class="submenu" data-dropdown="content">
				<li class="li">
					<a href="/admin/modulos/documentos/dados.php" class="link">Cadastrar</a>
				</li>
				<li class="li">
					<a href="/admin/modulos/documentos/gerenciar.php" class="link">Gerenciar</a>
				</li>
			</ul>
		</li>
		<?php if( $_SESSION['regraAdmin'] ): ?>
		<li class="li">
			<a class="link" data-dropdown="link">Usuários</a>
			<ul class="submenu" data-dropdown="content">
				<li class="li">
					<a href="/admin/modulos/usuarios/dados.php" class="link">Cadastrar</a>
				</li>
				<li class="li">
					<a href="/admin/modulos/usuarios/gerenciar.php" class="link">Gerenciar</a>
				</li>
			</ul>
		</li>
		<?php endif;?>
	</ul>
	<div class="box-sair">
		<i class="fa fa-cog" data-dropdown="link"><div class="clear"></div></i>
		<ul class="submenu" data-dropdown="content">
			<li class="li"><a href="/admin/modulos/usuarios/configuracoes.php" class="link">Configurações</a></li>
			<li class="li"><a href="/admin/logoff.php" class="link">Sair</a></li>	
		</ul>
	</div>
</aside>