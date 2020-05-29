<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\HttpFoundation\Response;

class InitDatabaseController extends AbstractController
{
    /**
     * @Route("/init-database", name="init_database")
     */
    public function index()
    {
        $this->addSql('CREATE TABLE empleados (id INT AUTO_INCREMENT NOT NULL, id_empleado INT NOT NULL, nombre VARCHAR(30) NOT NULL, apellido VARCHAR(30) NOT NULL, fecha_nacimiento DATETIME NOT NULL, rol VARCHAR(30) NOT NULL, usuario VARCHAR(30) NOT NULL, clave VARCHAR(30) NOT NULL, id_jefe INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        return $this->render('init_database/index.html.twig', [
            'controller_name' => 'InitDatabaseController',
        ]);
    }
}
