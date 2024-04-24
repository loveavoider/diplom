'use client';
import { Button, Stack, Box } from '@chakra-ui/react'
import Link from "next/link";
import TaskList from "@/app/components/TaskList";

function Index() {
    return (
        <>
            <Box display="flex" justifyContent="center">
                <Stack w="70%" mt={2} spacing={4} direction="row" justifyContent="space-between">
                    <Link href={"/login"}><Button colorScheme='green'>Войти</Button></Link>
                    <Link href={"/logup"}><Button colorScheme='purple'>Зарегистрироваться</Button></Link>
                </Stack>
            </Box>
            <Box w="100%" mt="200px" textAlign="center" fontSize="36px">Дипломная работа</Box>
        </>
    )
}

export default function Home() {
    // border="2px" borderColor="red.500"
    const jwt = localStorage.getItem('jwt');

    const isAuth = jwt !== null;

    return (
        <Box p="40px">
            {isAuth ? <TaskList /> : <Index/>}
        </Box>
    );
}
