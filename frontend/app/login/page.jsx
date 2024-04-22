import { Box, Editable, EditablePreview, EditableInput, Button } from "@chakra-ui/react";
import AuthForm from "@/app/components/AuthForm";

export default function Page() {
    return (
        <Box h="100vh" border="2px" p="40px" display="flex" justifyContent="center" position="relative">
            <AuthForm />
        </Box>
    )
}