<ul id="nav" class="sf-menu">
    <li class="current-menu-item"><a href="index.php"><?php if($_SESSION["idioma"]=="es"){echo "INICIO";}else{ echo "HOME"; }?>
    </a></li>
    <li><a href="#"><?php if($_SESSION["idioma"]=="es"){echo "MANTENIMIENTOS";}else{ echo "MAINTENANCE"; }?></a>
        <ul>
            <li><a href="#"><?php if($_SESSION["idioma"]=="es"){echo "Empresa";}else{ echo "Company"; }?></a>
                <ul>
                    <li><a href="RegistrarPersonal.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Personal";}else{ echo "Employees"; }?></span></a></li>
                    <li><a href="RegistrarUsuarios.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Usuarios del sistema";}else{ echo "User/System user"; }?></span></a></li>
                </ul>
            </li>
           

            <li><a href="RegistrarTipoProyecto.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Tipo de proyecto";}else{ echo "Project Type"; }?></span></a></li>
            <li><a href="RegistrarProyecto.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Proyecto";}else{ echo "Project"; }?></span></a></li>
            <li><a href="RegistrarEquipos.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Equipos";}else{ echo "Teams"; }?></span></a></li>
            <li><a href="RegistrarPersonalEquipo.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Registrar Personal a Equipo";}else{ echo "Team Personnel Register"; }?></span></a></li>
            <li><a href="RegistrarEntradas.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Entradas";}else{ echo "Entries"; }?></span></a></li>
            <li><a href="RegistrarSalidas.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Salidas";}else{ echo "Outputs"; }?></span></a></li>

           <li><a href="Reportes.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Nuevo reporte";}else{ echo "New report"; }?></span></a></li>
            <li><a href="#"><?php if($_SESSION["idioma"]=="es"){echo "Cat&aacute;logos";}else{ echo "Catalogs"; }?></a>
                <ul>
                    <li><a href="RegistrarProveedor.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Proveedor";}else{ echo "Provider"; }?></span></a></li>
                    <li><a href="RegistrarUnidadMedida.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Unidad de medida";}else{ echo "Unit of mesure"; }?></span></a></li>
                    <li><a href="RegistrarUnidad.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Unidades";}else{ echo "Units"; }?></span></a></li>
                    <li><a href="RegistrarLinea.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Lineas";}else{ echo "Lines"; }?></span></a></li>
                    <li><a href="RegistrarExperiencia.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Experiencia";}else{ echo "Experience"; }?></span></a></li>
                    <li><a href="RegistrarTipoEmpleado.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Tipo de empleado";}else{ echo "Type of employee"; }?></span></a></li>                    
                    <li><a href="RegistrarNivelConfianza.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Perfiles de usuario";}else{ echo "User profiles"; }?></span></a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li><a href="Portafolio.php"><?php if($_SESSION["idioma"]=="es"){echo "Portafolio";}else{ echo "Portfolio"; }?></a></li>
    <li><a href="#"><?php if($_SESSION["idioma"]=="es"){echo "Herramientas";}else{ echo "Tools"; }?></a>
        <ul>
            <li><a href="CambiarIdioma.php"><span><?php if($_SESSION["idioma"]=="es"){echo "Cambiar idioma";}else{ echo "Change language"; }?></span></a></li>
            <li><a href="ManualUsuario.pdf"><?php if($_SESSION["idioma"]=="es"){echo "Ayuda";}else{ echo "Help"; }?></a></li>
            <li><a href="http://www.gestionconstruccion.info"><span> <?php if($_SESSION["idioma"]=="es"){echo "Nosotros";}else{ echo "About us"; }?></span></a></li>
        </ul>
    </li>
    <li><a href="Logout.php"><?php if($_SESSION["idioma"]=="es"){echo "Salir";}else{ echo "Exit"; }?></a></li>
</ul>