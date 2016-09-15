<?php
namespace AppBundle\Security;

use AppBundle\Entity\Persona;
use AppBundle\Entity\Trayecto;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TrayectoVoter extends Voter
{
    const RESERVAR = "reservar";
    const PUBLICAR = "publicar";

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if ($attribute != self::RESERVAR && $attribute != self::PUBLICAR) {
            return false;
        }

        if (!$subject instanceof Trayecto) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     *
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Persona) {
            // the user must be logged in; if not, deny access
            return false;
        }

        /** @var Trayecto $trayecto */
        $trayecto = $subject;

        if ($attribute == self::PUBLICAR) {
            if (count($user->getTrayectos()) < 5) {
                return true;
            } else {
                return false;
            }
        } else if ($attribute == self::RESERVAR) {
            // Estoy logueado con el mismo usuario...
            if ($user->getId() == $trayecto->getConductor()->getId()) {
                return false;
            }

            if ($trayecto->getPlazasDisponibles() <= 0) {
                return false;
            }

            $pasajeros = $trayecto->getPasajeros()->toArray();
            if (in_array($user, $pasajeros)) {
                return false;
            }

            return true;
        }

    }
}
?>