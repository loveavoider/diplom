import {Box, Heading} from "@chakra-ui/react";
import Zakup from "@/app/components/Zakup";

export default function Anketa({ jurData }) {
    return (
        <Box>
            <Heading size="md" mt="16px">Общая информация о клиенте</Heading>

            <Box mt="16px">
                <Box as="label">
                    Полное наименование юридического лица:
                    <Zakup val={jurData.data.name.full_with_opf} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    Юридический адрес:
                    <Zakup val={jurData.data.address.unrestricted_value} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    ОГРН:
                    <Zakup val={jurData.data.ogrn} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    ОКАТО:
                    <Zakup val={jurData.data.okato} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    ОКПО:
                    <Zakup val={jurData.data.okpo} />
                </Box>
            </Box>

            { jurData.data?.management ?
                <Box mt="16px">
                    <Box as="label">
                        {jurData.data.management.post}:
                        <Zakup val={jurData.data.management.name} />
                    </Box>
                </Box> : ''
            }
        </Box>
    )
}