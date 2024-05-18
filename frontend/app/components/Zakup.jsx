import {Box} from "@chakra-ui/react";

export default function Zakup({ val }) {
    return (
        <Box mt="4px" border="1px" p="5px" borderRadius="10px" bgColor="gray.100" borderColor="gray.300">
            { val }
        </Box>
    )
}