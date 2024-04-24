'use client';
import {Editable, EditablePreview, EditableInput, Button, Stack, FormControl, FormHelperText, FormErrorMessage} from "@chakra-ui/react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import { sendRequest } from "@/app/util/axios";
import { useState } from "react";
import { useRedirect } from "@/app/util/redirect";

async function logIn(login, password) {
    const data = {username: login, password: password}
    const res = await sendRequest('post', data, 'auth/token/login');
    localStorage.setItem('jwt', res.data.token);
    localStorage.setItem('refresh', res.data.refresh_token);

    await useRedirect('/');
}

async function logUp(login, password) {
    const data = {login: login, password: password, inn: "1231"}

    await sendRequest('post', data, 'auth/logUp');

    await useRedirect('/');
}

function AuthAction(isLogUp, login, password) {
    let credentials = {
        login: login,
        password: password
    };

    isLogUp ? logUp(credentials.login, credentials.password) : logIn(credentials.login, credentials.password);
}

export default function AuthForm() {

    const [login, setLogin] = useState('');
    const [password, setPassword] = useState('');

    const isLogUp = usePathname() !== '/login';

    return (
        <FormControl w="30%" minH="100%" position="absolute" top="30%">
            <Editable onChange={(e) => setLogin(e)} placeholder='login' border="1px" borderColor="gray.300" borderRadius="10px" p="2px">
                <EditablePreview w="100%" />
                <EditableInput  w="100%" />
            </Editable>

            <Editable onChange={(e) => setPassword(e)} mt="40px" placeholder='password' border="1px" borderColor="gray.300" borderRadius="10px" p="2px">
                <EditablePreview w="100%" />
                <EditableInput  w="100%" />
            </Editable>

            <Stack mt="20px" direction="row" justifyContent="center">
                <Button colorScheme="pink" onClick={() => AuthAction(isLogUp, login, password)}>
                    {isLogUp ? 'Зарегистрироваться' : 'Войти'}
                </Button>
                <Link href={"/"}>
                    <Button>На главную</Button>
                </Link>
            </Stack>

        </FormControl>
    )
}