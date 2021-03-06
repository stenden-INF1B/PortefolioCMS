<?php
/**
 * Author: Joris Rietveld <jorisrietveld@gmail.com>
 * Created: 06-01-2017 16:07
 * Licence: GNU General Public licence version 3 <https://www.gnu.org/licenses/quick-guide-gplv3.html>
 */
declare( strict_types = 1 );

namespace StendenINF1B\PortfolioCMS\Controller;

use StendenINF1B\PortfolioCMS\Kernel\Authorization\User as AuthorizedUser;
use StendenINF1B\PortfolioCMS\Kernel\BaseController;
use StendenINF1B\PortfolioCMS\Kernel\Http\Request;
use StendenINF1B\PortfolioCMS\Kernel\Http\Response;

class Authentication extends BaseController
{
    use SiteHelper;

    const ANONYMOUS_USER = 0;
    const STUDENT = 1;
    const TEACHER = 2;
    const SLB_TEACHER = 3;
    const ADMIN = 4;

    protected $requiredLoginFields = [
        'email',
        'password',
    ];

    /**
     * This action is for handling the Login route.
     *
     * @param Request|null $request
     * @return Response
     */
    public function index( Request $request )
    {
        if ( $request->postParams->has( 'email' ) && $request->postParams->has( 'password' ) )
        {
            $authorizationLevel = $this->validateUser( $request->getPostParams()->getString( 'email' ), $request->getPostParams()->getString( 'password' ) );

            if ( $authorizationLevel )
            {
                if ( $authorizationLevel === AuthorizedUser::ADMIN )
                {
                    $this->redirect( '/admin/gebruikersOverzicht' );
                }
                elseif ( $authorizationLevel === AuthorizedUser::STUDENT )
                {
                    $this->redirect( '/admin/editStudent/' . $_SESSION[ 'userId' ] );
                }
                elseif ( $authorizationLevel === AuthorizedUser::SLB_TEACHER || $authorizationLevel === AuthorizedUser::TEACHER )
                {
                    $this->redirect( '/admin/editTeacher/' . $_SESSION[ 'userId' ] );
                }
            }
            else
            {
                return $this->createResponse( 'site:login', [
                        'portfolioMenuLinks' => $this->renderMenuLinks(),
                        'login-feedback'     => 'De combinatie van wachtwoord gebruikersnaam is niet gevonden in onze database.',
                        'asset-path'         => $request->getBaseUri() . 'assets/site/',
                    ]
                );
            }
        }
        // Normal login request so render the login page.
        return $this->createResponse( 'site:login', [
            'portfolioMenuLinks' => $this->renderMenuLinks(),
            'asset-path'         => $request->getBaseUri() . 'assets/site/',
        ] );
    }

    /**
     * This method de authenticates an user.
     *
     * @param Request $request
     * @return Response
     */
    public function logout( Request $request )
    {
        // Destroy the session and remove the session cookie.
        $_SESSION = [];
        $cookieParams = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $cookieParams[ "path" ],
            $cookieParams[ "domain" ],
            $cookieParams[ "secure" ],
            $cookieParams[ "httponly" ]
        );
        session_destroy();

        return $this->redirect( '/login' );
    }

    /**
     * This method checks if the user used valid authentication credentials.
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    protected function validateUser( string $email, string $password )
    {
        $teacherRepository = $this->getEntityManager()->getRepository( 'Teacher' );
        $studentRepository = $this->getEntityManager()->getRepository( 'Student' );

        $student = $studentRepository->getByEmail( $email );
        $teacher = $teacherRepository->getByEmail( $email );

        // Check if the user is found in the database.
        if ( $student->getId() < 1 && $teacher->getId() < 1 )
        {
            return FALSE;
        }

        $user = ( $student->getId() < 1 ) ? $teacher : $student;

        // Check the inputted password with the stored hash.
        if ( !password_verify( $password, $user->getHashedPassword() ) )
        {
            return FALSE;
        }

        $_SESSION[ 'userId' ] = $user->getId();
        $_SESSION[ 'name' ] = $user->getFirstName() . ' ' . $user->getLastName();

        switch ( TRUE )
        {
            case $user->getIsAdmin():
                return $_SESSION[ 'authorizationLevel' ] = AuthorizedUser::ADMIN;

            case $user->getId() == $student->getId():
                return $_SESSION[ 'authorizationLevel' ] = AuthorizedUser::STUDENT;

            case $user->getIsSLBer():
                return $_SESSION[ 'authorizationLevel' ] = AuthorizedUser::SLB_TEACHER;

            default:
                return $_SESSION[ 'authorizationLevel' ] = AuthorizedUser::TEACHER;
        }
    }
}