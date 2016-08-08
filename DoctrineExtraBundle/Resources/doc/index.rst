Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require kaliber5/doctrine-extra-bundle

TBD...


Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the ``app/AppKernel.php`` file of your project:

.. code-block:: php

    <?php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new Kaliber5\DoctrineExtraBundle\Kaliber5DoctrineExtraBundle(),
            );

            // ...
        }

        // ...
    }


Step 2: Use the UTCDateTimeType
-------------------------------

Register the UTCDateTimeType for Doctrine in the config.yml

.. code-block:: yml
# ..
doctrine:
    dbal:
        types:
            datetime: Kaliber5\DoctrineExtraBundle\DoctrineExtensions\DBAL\Types\UTCDateTimeType
            datetimetz: Kaliber5\DoctrineExtraBundle\DoctrineExtensions\DBAL\Types\UTCDateTimeType
            date: Kaliber5\DoctrineExtraBundle\DoctrineExtensions\DBAL\Types\UTCDateTimeType


Then Dcotrine will use the UTCDateTimeType for mapping the column types datetime, datetimetz and date