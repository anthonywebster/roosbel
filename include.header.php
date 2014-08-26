<header>
    <nav id="pagemenu">
        <?php if ($menu) { ?>
            <ul>
                <li><a href="./" class="<?php echo $index == true ? 'active' :''; ?>">Inicio</a></li>
                <?php foreach ($menu as $key => $value) { ?>
                    <li><a href="<?php echo $value['link'] ?>" class="<?php echo  isset($id) &&  $key == $id ? 'active' :''; ?>" ><?php echo $value['name'] ?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <ul>
    </nav>
    
    <h1><a href="./"></a></h1>
</header>