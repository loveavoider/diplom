'use client';
import {Editable, EditablePreview, EditableInput, Button, Stack, FormControl, FormHelperText, FormErrorMessage} from "@chakra-ui/react";
import Link from "next/link";
import { usePathname } from "next/navigation";
import axios from "axios";
import { API } from "@/app/constants";

function logIn(login, password) {
    axios.post(`${API}/api/auth/token/login`, {
        login: login,
        password: password
    })
        .then((res) => {
            console.log(res)
        });
}

function logUp(login, password) {
    axios.post(`${API}/login`, {
        login: login,
        password: password
    })
        .then((res) => {
            console.log(res)
        });
}

function AuthAction(isLogUp, credentials) {
    isLogUp ? logUp(credentials.login, credentials.password) : logIn(credentials.login, credentials.password);
}

export default function AuthForm() {
    let inps = document.getElementsByTagName("input");
    let credentials = {
        login: '',
        password: ''
    };

    for (let i = 0; i < inps.length; i++) {
        const key = inps[i].getAttribute("placeholder");
        credentials[key] = inps[i].value;
    }

    const isLogUp = usePathname() !== '/login';

    return (
        <FormControl w="30%" minH="100%" position="absolute" top="30%">
            <Editable placeholder='login' border="1px" borderColor="gray.300" borderRadius="10px" p="2px">
                <EditablePreview w="100%" />
                <EditableInput  w="100%" />
            </Editable>

            <Editable mt="40px" placeholder='password' border="1px" borderColor="gray.300" borderRadius="10px" p="2px">
                <EditablePreview w="100%" />
                <EditableInput  w="100%" />
            </Editable>

            <Stack mt="20px" direction="row" justifyContent="center">
                <Button colorScheme="pink" onClick={() => AuthAction(isLogUp, credentials)}>
                    {isLogUp ? 'Зарегистрироваться' : 'Войти'}
                </Button>
                <Link href={"/"}>
                    <Button>На главную</Button>
                </Link>
            </Stack>

        </FormControl>
    )
}