<?php
/**
 * This file is part of JohnCMS Content Management System.
 *
 * @copyright JohnCMS Community
 * @license   https://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link      https://johncms.com JohnCMS Project
 *
 * @author Akbarali
 * Date: 27.06.2022
 * @telegram @kbarli
 * @website http://akbarali.uz
 * Email: Akbarali@uzhackersw.uz
 * Johncms Профил: https://johncms.com/profile/?user=38217
 * На тему: https://johncms.com/forum/?type=topic&id=12200
 */

namespace Notifications\Install;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Created by PhpStorm.
 * Filename: SenjeInstaller.php
 * Project Name: john.loc
 * Author: Акбарали
 * Date: 27/06/2022
 * Time: 18:25
 * Github: https://github.com/akbarali1
 * Telegram: @akbar_aka
 * E-mail: me@akbarali.uz
 */
class SenjeInstaller
{
    public static function install()
    {
        $schema = Capsule::Schema();
        if (! $schema->hasColumn('notifications', 'notificated')) {
            $schema->table('notifications', function (Blueprint $table) {
                $table->boolean('notificated')->default(false);
            });
        }
    }

}
