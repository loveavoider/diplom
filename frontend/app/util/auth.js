import {redirect} from "next/navigation";

export function setTokens(jwt, refresh) {
    localStorage.setItem('jwt', jwt);
    localStorage.setItem('refresh', refresh);
}

export function haveJWT() {
    const jwt = localStorage.getItem('jwt');
    if (Boolean(jwt) && Boolean(jwt.length)) {
        return true;
    }

    redirect('/');
}