import { Button, Stack, Box } from '@chakra-ui/react'
import Link from "next/link";

export default function Home() {
    // border="2px" borderColor="red.500"
    return (
        <Box p="40px">
            <Box display="flex" justifyContent="center">
                <Stack w="70%" mt={2} spacing={4} direction="row" justifyContent="space-between">
                    <Link href={"/login"}><Button colorScheme='green'>Войти</Button></Link>
                    <Link href={"/logup"}><Button colorScheme='purple'>Зарегистрироваться</Button></Link>
                </Stack>
            </Box>
            <Box w="100%" mt="200px" textAlign="center" fontSize="36px">Дипломная работа</Box>
        </Box>
    );
}
